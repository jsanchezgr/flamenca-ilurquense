<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class SubscriberController extends Controller
{
    public function newSubscription(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $email = request(['email'])['email'];

        /** @var Subscriber $subscription */
        $subscription = Subscriber::where('email', $email)->first();

        if ($subscription === null)
        {
            $subscription = Subscriber::create([
                'email' => $email,
                'subscribed' => false,
            ]);
        }
        else if ($subscription->verified)
        {
            if ($subscription->subscribed)
            {
                return response()->json(['message' => 'ALREADY_SUBSCRIBED'], Response::HTTP_CONFLICT);
            }
            else
            {
                $subscription->verify(false);
            }
        }

        $subscription->notifyVerification();

        return response()->json(['message' => 'CONFIRMATION_EMAIL_SENT'], Response::HTTP_OK);
    }

    public function verifySubscription(Request $request): JsonResponse
    {
        $request->validate(['token' => 'required|string']);

        $token = request(['token'])['token'];

        $subscription = Subscriber::where('token', $token)->first();

        if (!$subscription)
        {
            abort(Response::HTTP_NOT_FOUND);
        }

        $subscription->verify(true);
        $subscription->subscribe(true);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
