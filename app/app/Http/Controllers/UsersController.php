<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = DB::select(
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name)
            FROM users u
                 JOIN (SELECT user_id, COUNT(*) as user_kits
                       FROM user_kits
                       GROUP BY user_id) AS uk
                      ON u.id = uk.user_id
                 JOIN (SELECT user_id, SUM(array_length(used_items, 1) * per_items) as sum
                       FROM documents
                       GROUP BY user_id) AS d
                      ON u.id = d.user_id
            WHERE sum > user_kits"
        );

        return response()->json($users, 200);
    }
}
