<?php

namespace AndeCollege\AndeCollege\Repository;

class UserRepository
{
	/**
	 * Find Users by their Emails
	 * @param  string $email
	 * @return Collection
	 */
	public function findUserByEmail($email)
	{
		return $user = User::where('email', '=', $email)->first();
	}
}