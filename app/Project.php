<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use App\Libs\GitHubClient;

class Project extends Model
{
    use SoftDeletes;

    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['name', 'description', 'project_url', 'source_url'];

    /** @var array The accessors to append to the model's array form. */
    protected $appends = ['github_project_id'];

    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function getGithubProjectIdAttribute(): string
    {
        preg_match('/https?:\/\/(?:www\.)?github\.com\/(.+)\/(.+)\/?/', $this->source_url, $matches);
        [$url, $owner, $repo] = $matches;

        return "{$owner}/{$repo}";
    }

    /**
     * Return the number of GitHub stars the project has.
     *
     * @return int|null
     */
    public function forks()
    {
        [$owner, $repo] = explode('/', $this->github_project_id);
        $repository = App::make(GitHubClient::class)->repository($owner, $repo);

        return $repository->forks_count ?? 'UNKNOWN';
    }

    /**
     * Return the number of GitHub stars the project has.
     *
     * @return int|null
     */
    public function stars()
    {
        [$owner, $repo] = explode('/', $this->github_project_id);
        $repository = App::make(GitHubClient::class)->repository($owner, $repo);

        return $repository->stargazers_count ?? 'UNKNOWN';
    }
}
