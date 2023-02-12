<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Episode
 *
 * @property int $id
 * @property int $season
 * @property int $day
 * @property string $section
 * @property string $title
 * @property string $speakers
 * @property string $source
 * @property string|null $slide
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Episode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Episode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Episode query()
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereSlide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereSpeakers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereUpdatedAt($value)
 */
	class Episode extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $line_user_id
 * @property string $name
 * @property string $verify_code
 * @property string|null $status
 * @property string|null $avatar_url
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLineUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerifyCode($value)
 */
	class User extends \Eloquent {}
}

