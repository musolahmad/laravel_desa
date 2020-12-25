<table align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="border-collapse: collapse;">
                            <tr>
                                <td align="center" bgcolor="#F5FFFA">
                                    <h1><center>Aduan Masyarakat Desa Jeruksari</center></h1>
                                    <p><center>Jalan Raya Jeruksari no 381 Desa Jeruksari, Kecamatan Tirto, Kabupaten Pekalongan</center></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 30px 10px 30px;">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td >                                            	
                                                <p>Yth. Bpk/Ibu/Sdr/i {{$tb_user->nama_depan}} {{$tb_user->nama_belakang}},</p>                                        
                                                <p>Terima Kasih telah menggunakan Website Desa Jeruksari<br>
                                                Berikut ini adalah password Anda di Website Desa Jeruksari</p>
                                                <table align="center" cellpadding="0" cellspacing="0" width="50%">
                                                    <td align="center" bgcolor="#6495ED">
                                                        <p><b><font size="5" color="white">Password Anda : {{Crypt::decryptString($tb_user->password)}}</font></b></p>
                                                    </td>
                                                </table>                                
                                                <p>Kami perlu memastikan bahwa email Anda benar dan tidak disalahgunakan oleh pihak yang tidak berkepentingan.</p>

                                                Salam hormat kami,<br>
                                                Admin Website Desa Jeruksari
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#98FB98" style="padding: 10px 10px 10px 30px;">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td>
                                                Surel ini dikirimkan secara otomatis dan tidak untuk dibalas. Terima kasih.
                                            </td>
                                        </tr>
                                    </table>
                                </td>   
                            </tr>
                        </table>