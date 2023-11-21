<?php

namespace App\Http\Middleware;
use App\Models\Mahasiswa;
use Closure;

class Authorization
{
    /**
     * * Handle an incoming request.
     * *
     * * @param \Illuminate\Http\Request $request
     * * @param \Closure $next
     * * @return mixed
     * */

    public function handle($request, Closure $next)
    {
        $token = $request->header('token') ?? $request->query('token');
        if (!$token) {
            return response()->json([
                'status' => 'Error',
                'message' => 'token not provided',
            ], 400);
        }
        
        $mahasiswa = Mahasiswa::where('token', $token)->first();
        //
        if (!$mahasiswa) {
            return response()->json([
                'status' => 'Error',
                'message' => 'invalid token',
            ], 400);
        }
        $request->mahasiswa = $mahasiswa;
        return $next($request);
    }

    private function base64url_encode(string $data): string
    {
        $base64 = base64_encode($data);
        $base64url = strtr($base64, '+/', '-_');

        return rtrim($base64url, '=');
    }
    private function base64url_decode(string $base64url): string
    {
        $base64 = strtr($base64url, '-_', '+/');
        $json = base64_decode($base64);

        return $json;
    }
    private function sign(string $header_base64url, string $payload_base64url, string $secret): string
    {
        $signature = hash_hmac('sha256', "{$header_base64url}.{$payload_base64url}", $secret, true);
        $signature_base64url = $this->base64url_encode($signature);

        return $signature_base64url;
    }
    private function verify(string $signature_base64url, string $header_base64url, string $payload_base64url, string $secret): bool
    {
        $signature = $this->base64url_decode($signature_base64url);
        $expected_signature = $this->base64url_decode($this->sign($header_base64url, $payload_base64url, $secret));

        return hash_equals($expected_signature, $signature);
    }
}