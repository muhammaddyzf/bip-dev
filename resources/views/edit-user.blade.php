<html>
	<form method="POST" enctype="multipart/form-data" action="http://banteninformationproduct.com/api/v1/user/update">
		ID User : <input type="text" name="id_user"/></br>
		NIK : <input type="text" name="nik"/></br>
		Email : <input type="text" name="email"/></br>
		Password : <input type="text" name="password"/></br>
		fullname : <input type="text" name="fullname"/></br>
		telpon : <input type="text" name="telpon"/></br>
		pendidikan : <input type="text" name="pendidikan"/></br>
		alamat : <input type="text" name="alamat"/></br>
		<!-- is_req_update_password : <input type="text" name="is_req_update_password"/></br> -->
		Foto : <input type="file" name="lampiran"/>
		<input type="submit" value="kirim"/>
	</form>
</html>