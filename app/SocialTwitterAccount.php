<?php

// SocialTwitterAccount.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialTwitterAccount extends Model
{
  protected $table = 'social_twitter_accounts';

  protected $fillable = ['user_id', 'provider_user_id', 'provider', 'token', 'tokenSecret'];

  public function user()
  {
      return $this->belongsTo(User::class);
  }
}