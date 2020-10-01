<?php

namespace App;

use App\GitHub\Client as GitHubClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['name', 'description', 'project_url', 'source_url'];

    /** @var array The accessors to append to the model's array form. */
    protected $appends = ['github_project_id'];

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /** @var array The relations to eager load on every query. */
    protected $with = ['skills'];

    /** Return the project's GitHub ID. */
    public function getGithubProjectIdAttribute(): string
    {
        preg_match('/https?:\/\/(?:www\.)?github\.com\/(.+)\/(.+)\/?/', $this->source_url, $matches);
        [$url, $owner, $repo] = $matches;

        return "{$owner}/{$repo}";
    }

    /** Get the project's skills. */
    public function skills()
    {
        return $this->morphToMany('App\Skill', 'skillable');
    }

    /**
     * Return the number of GitHub stars the project has.
     *
     * @return int|null
     */
    public function forks()
    {
        return $this->repository()->forks_count ?? 'UNKNOWN';
    }

    /**
     * Return the number of GitHub stars the project has.
     *
     * @return int|null
     */
    public function stars()
    {
        return $this->repository()->stargazers_count ?? 'UNKNOWN';
    }

    /**
     * Get the projects repository information.
     *
     * @return object
     */
    protected function repository()
    {
        [$owner, $repo] = explode('/', $this->github_project_id);

        return App::make(GitHubClient::class)->repository($owner, $repo);
    }
}
