<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $rijad = User::create([
            'name'              => 'Rijad Sekiraqa',
            'email'             => 'rijad@test.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $besnik = User::create([
            'name'              => 'Besnik Gashi',
            'email'             => 'besnik@test.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $ardit = User::create([
            'name'              => 'Ardit Krasniqi',
            'email'             => 'ardit@test.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $linda = User::create([
            'name'              => 'Linda Berisha',
            'email'             => 'linda@test.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $tags = Tag::factory(8)->create();

        // Rijad's projects
        $rijadProjects = Project::factory(3)->create(['user_id' => $rijad->id]);

        $rijadProjects->each(function (Project $project) use ($tags, $besnik, $ardit) {
            $issues = Issue::factory(4)->create(['project_id' => $project->id]);

            $issues->each(function (Issue $issue) use ($tags, $besnik, $ardit) {
                $issue->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
                $issue->members()->attach([$besnik->id, $ardit->id]);
                Comment::factory(3)->create(['issue_id' => $issue->id]);
            });
        });

        // Besnik's projects
        $besnikProjects = Project::factory(2)->create(['user_id' => $besnik->id]);

        $besnikProjects->each(function (Project $project) use ($tags, $rijad, $linda) {
            $issues = Issue::factory(3)->create(['project_id' => $project->id]);

            $issues->each(function (Issue $issue) use ($tags, $rijad, $linda) {
                $issue->tags()->attach($tags->random(rand(1, 2))->pluck('id'));
                $issue->members()->attach([$rijad->id, $linda->id]);
                Comment::factory(2)->create(['issue_id' => $issue->id]);
            });
        });

        // Ardit's projects
        $arditProjects = Project::factory(2)->create(['user_id' => $ardit->id]);

        $arditProjects->each(function (Project $project) use ($tags, $rijad, $linda) {
            $issues = Issue::factory(3)->create(['project_id' => $project->id]);

            $issues->each(function (Issue $issue) use ($tags, $rijad, $linda) {
                $issue->tags()->attach($tags->random(rand(1, 2))->pluck('id'));
                $issue->members()->attach([$rijad->id, $linda->id]);
                Comment::factory(2)->create(['issue_id' => $issue->id]);
            });
        });

        // Linda's projects
        $lindaProjects = Project::factory(2)->create(['user_id' => $linda->id]);

        $lindaProjects->each(function (Project $project) use ($tags, $besnik, $ardit) {
            $issues = Issue::factory(3)->create(['project_id' => $project->id]);

            $issues->each(function (Issue $issue) use ($tags, $besnik, $ardit) {
                $issue->tags()->attach($tags->random(rand(1, 2))->pluck('id'));
                $issue->members()->attach([$besnik->id, $ardit->id]);
                Comment::factory(2)->create(['issue_id' => $issue->id]);
            });
        });
    }
}