<!DOCTYPE html>
<html>
<head>
	<title>Hi</title>
</head>
<body>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="{{$users_attribut->nama}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tempat_lahir" placeholder="tempat lahir" name="tempat_Lahir" value="{{$users_attribut->tempat_lahir}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tgl_lahir" placeholder="tanggal lahir" name="tgl_lahir" value="{{$users_attribut->tgl_lahir}}">
                        </div>
                        <div class="form-group">
                           
                            <input type="text" class="form-control" id="alamat" placeholder="alamat" name="alamat" value="{{$users_attribut->alamat}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="no_handphone" placeholder="no.handphone" name="no_hp" value="{{$users_attribut->no_hp}}">
                        </div>
                        <div class="form-group">
                           
                            <input type="text" class="form-control" id="jurusan" placeholder="jurusan" name="jurusan_prodi" value="{{$users_attribut->jurusan_prodi}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tahun_masuk" placeholder="tahun masuk" name="th_masuk" value="{{substr($users_attribut->th_masuk,0,4)}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="tahun_lulus" placeholder="tahun lulus" name="th_lulus" value="{{substr($users_attribut->th_lulus,0,4)}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status" placeholder="status" name="status" value="{{$users_attribut->status}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status" placeholder="tempat bekerja" name="tempat_bekerja" value="{{$users_attribut->tempat_bekerja}}">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" id="status" placeholder="waktu lulus kerja" name="waktu_lulus_bekerja" value="{{substr($users_attribut->waktu_lulus_bekerja,0,4)}}">
                        </div>
                </div>

                

</body>
</html>