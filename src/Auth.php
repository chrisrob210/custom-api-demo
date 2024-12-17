<?php

class Auth
{
    public function isAuthorized($request)
    {
        if ($request->headers() == null) {
            return response('Incorrect Or Missing Credentials', 503, 'Access Denied');
        }

        if ($request->headers('AUTHORIZATION')) {
            /** @todo check if token is properly hashed */
            return $this->hash_equals($request->headers('AUTHORIZATION'),$_ENV['CLIENT_TOKEN']);
        }
    }

    // public function generateToken()
    // {
    //     //response(hash('sha256','08082022'));
    //     return hash('sha256','AUGUST8TH2022');
    // }

    private function hash_equals($str1, $str2)
    {
        if (strlen($str1) != strlen($str2)) {
            return array(array('token' => $str1), array('generated signature' => $str2), false);
        } else {
            $res = $str1 ^ $str2;
            $ret = 0;
            for ($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
            //return !$ret;
            return !$ret;
        }
    }

    private function encode($str){
        return str_replace(array('+', '/', '='), array('-', '_', ''), $str);
    }
}
