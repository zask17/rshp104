@extends('layouts.app')

@section('title', 'BERANDA - RSHP UNAIR')

@section('content')
    <header class="head">
        <h1 classs="judul">Selamat Datang di RSHP Universitas Airlangga</h1>
    </header>
   
    <section style="padding: 2rem;">
        <table width="100%" ceellspacing="20">
            <tr>
                <!-- LEFT SECTION -->
                <td width="50%" valign="top">
                    <h2 class="pendaftaran"><a href="#">PENDAFTARAN ONLINE</a></h2>
                    <p>
                        Rumah Sakit Hewan Pendidikan Universitas Airlangga berinovasi untuk selalu meningkatkan kualitas pelayanan, maka dari itu Rumah Sakit Hewan Pendidikan Universitas Airlangga mempunyai fitur pendaftaran online yang mempermudah untuk mendaftarkan hewan kesayangan Anda
                    </p>
                        <h3>INFORMAS JADWAL DOKTER</h3>
                </td>
        
                <!-- RIGHT SECTION -->
                <td width="50%" valign="top">
                    <iframe width="100%" height="315" 
                        src="https://www.youtube.com/embed/rCfvZPECZvE?loop=1" 
                        frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
                    </iframe>
                </td>
        </table>
    </section>

    <section class="content">
        <h2 class="subjudul">LOKASI RSHP</h2>
            <p style="text-align:center">GEDUNG RS HEWAN PENDIDIKAN</p>
            <p style="text-align:center">Kampus C Universitas Airlangga, Mulyorejo, Kec. Mulyorejo, Surabaya, Jawa Timur 60115, Indonesia.</p>
            
            <div style="text-align: center;"><iframe style="text-align:center" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7915.482022032093!2d112.788135!3d-7.270285!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd40a9784f5%3A0xe756f6ae03eab99!2sAnimal%20Hospital%2C%20Universitas%20Airlangga!5e0!3m2!1sen!2sus!4v1755250825759!5m2!1sen!2sus"
            width="600" height=auto style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </div></iframe>      
    </section>
@endsection