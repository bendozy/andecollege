<?php

namespace AndeCollege\AndeCollege\Repository;

use AndeCollege\User;

class SocialiteRepository
{
	/**
	 * Find Users by their Social Details
	 * @param  string $email
	 * @return Collection
	 */
	public function findUserByProviderAndID($provider,$id)
	{
		return null;//''$user = User::where('email', '=', $email)->first();
	}
}