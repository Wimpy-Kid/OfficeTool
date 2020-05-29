<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserModule\CreateTicketUser;
use App\Http\Requests\UserModule\CreateTicktUser;
use App\Models\Calendar;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


	public function getUsers(CreateTicketUser $request) {
		$new_users = [];
		if ( $request->isMethod('post') && $request->input('username')) {
			$new_user = User::query()->create([
				'name' => $request->input('username'),
				'need_ticket' => $request->input('need_ticket') == 1
			]);
			$new_users[ $new_user->getAttribute('id') ] = $new_user->toArray();
		}

		$users = User::query()->orderBy("name", "desc")->get();

		return view("lunch_ticket", ["users" => $users, 'new_users' => $new_users]);
	}

	public function generateLunchTicket(Request $request) {

		$date = $request->input("date", today());

		$users = User::query()
		             ->whereIn("id", $request->input("users"))->get();

		$special_days = Calendar::query()
		                        ->where("year", date("y", strtotime($date)))
		                        ->get()->keyBy("type")->toArray();

		User::query()->whereIn("id", $request->input("users"))->update(["need_ticket" => true]);
		User::query()->whereNotIn("id", $request->input("users"))->update(["need_ticket" => false]);

		return view(
			"templates/lunch_ticket",
			["users" => $users, "date" => $date, "special_days" => $special_days]
		);
	}

}
