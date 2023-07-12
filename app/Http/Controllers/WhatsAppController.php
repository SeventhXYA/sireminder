<?php

namespace App\Http\Controllers;

use App\Pegawai;

class WhatsAppController extends Controller
{
    public function sendMessage()
    {
        $curl = curl_init();
        $token = 'PiCGuCN!I1-yxe!W7NwE';
        $bupati = Pegawai::where('id_jabatan', 3)->first();
        $target = $bupati->nohp;

        $string = '$bupati->nohp = ' . $target;


        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $string,
                'message' => '*RENCANA KERJA BUPATI BALANGAN*
Anda memiliki rencana kerja terbaru, silahkan cek melalui: https://sireminderbalangan.com atau anda bisa mendownloadnya
                
*Sebelum dan sesudahnya ulun ucapkan terima kasih.*',
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return redirect()->back()->with('success', 'Berhasil mengirimkan pesan WhatsApp!');
    }
}
