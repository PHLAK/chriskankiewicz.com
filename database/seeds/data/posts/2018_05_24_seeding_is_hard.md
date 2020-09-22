---
title: Seeding is Hard
excerpt: |-
    We've all been there... banging our heads against a wall for 20 minutes
    wondering why our app isn't working before we realize we forgot to seed our
    database when running migrations. Okay, easy fix...
tags: ['Laravel', 'PHP', 'Code']
published: 2018-05-24 01:23:45
---

We've all been there... banging our heads against a wall for 20 minutes
wondering why our app isn't working before we realize we forgot to seed our
database when running migrations. Okay, easy fix:

    $ php artisan migrate --seed
    Migration table created successfully.
    Migrating: 1996_02_27_123456_create_pokemon_table
    Migrated:  1996_02_27_123456_create_pokemon_table
    Seeding: PokemonSeederReflectionException : Class PokemonSeeder does not exist

Sigh... okay. I should have remembered to refresh the the autoload file first.
My bad.

    $ composer dump-autoload
    $ php artisan migrate --seed
    Nothing to migrate.
    Seeding: PokemonSeederIlluminate\Database\QueryException  : SQLSTATE[23000]: Integrity constraint violation: 19 UNIQUE constraint failed: pokemon.id (SQL: insert into "pokemon" ("id", "name", "description") values (25, Pikachu, Whenever Pikachu comes across something new, it blasts it with a jolt of electricity.))

### (╯°□°）╯︵ ┻━┻

Ugh... maybe the fix isn't as easy as I thought. I must have had some left over data there. I'm pretty sure that data is old so I'll just refresh the database.

    $ php artisan migrate:fresh --seed
    Dropped all tables successfully.
    Migration table created successfully.
    Migrating: 1996_02_27_123456_create_pokemon_table
    Migrated:  1996_02_27_123456_create_pokemon_table
    Seeding: PokemonSeeder

Finally things are going my way. ┬─┬ノ( º _ ºノ)

However, I should make a mental note to run the seeds individually on prod since
we can't just refresh the data there. I wont forget... hopefully.

Now to make sure the tests are passing.

    $ phpunit 
    PHPUnit 7.1.5 by Sebastian Bergmann and contributors
    
    ...................F.                                  20 / 20 (100%)
    
    Time: 1.33 minutes, Memory: 40.00MB
    
    There was 1 failure:
    
    1) Tests\Feature\PokemonTest::test_it_can_retrieve_a_pokemon_by_id
    Invalid JSON was returned from the route.

### ┻━┻ ︵ヽ(`Д´)ﾉ︵ ┻━┻

In the aftermath historians identified that the tests failed due to missing 
`$this->seed('PokemonSeeder')`.

The solution: Seed your initial data in your migrations.

<script src="https://gist.github.com/PHLAK/e14bc99b459c01a13bba12b147e5b97c.js"></script>

With this, all the above troubles are alleviated and all you have to do is 
remember to run `artisan migrate`. This simple and elegant solution has several
benefits:

  - Guarantees data is seeded during `artisan migrate` (without `--seed`)
  - Prevents accidental re-seeding on subsequent migrations
  - Eliminates the need for `$this->seed()` in your test cases
  - Avoids the annoying `Class does not exist` errors
