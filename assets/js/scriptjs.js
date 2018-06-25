$(document).ready(function(){
	$('#example1').DataTable();

	var Inteval;

	Interval = setInterval(function(){
		Notifikasi()
	},1000)

	function Notifikasi(){
		$.ajax({
			url:'http://[::1]/jdih/index.php/Dashboard/KontakMasuk/Message_ajax',
			success:function(data){
				if (data > 0){
					$('#notifi').css('color','yellow');
					$('#isi').html(data+' Pesan baru');
					$('#value').html(data);
				}
				if (data == 0){
					$('#isi').html(data+' Pesan baru');
				}
			}
		});
	}


});