//title
(function () {
var original = document.title;
var timeout;

window.flashTitle = function (newMsg, howManyTimes) {
    function step() {
        document.title = (document.title == original) ? newMsg : original;

        if (--howManyTimes > 0) {
            timeout = setTimeout(step, 1000);
        };
    };

    howManyTimes = parseInt(howManyTimes);

    if (isNaN(howManyTimes)) {
        howManyTimes = 5;
    };

    cancelFlashTitle(timeout);
    step();
};

window.cancelFlashTitle = function () {
    clearTimeout(timeout);
    document.title = original;
};

}());




//*********************notification********************************************//
function onShowNotification () {
	console.log('notification is shown!');
}

function onCloseNotification () {
	console.log('notification is closed!');
}

function onClickNotification () {
	window.focus();
	console.log('notification was clicked!');
	
}

function onErrorNotification () {
	console.error('Error showing notification. You may need to request permission.');
}

function onPermissionGranted () {
	console.log('Permission has been granted by the user');
	doNotification();
}

function onPermissionDenied () {
	console.warn('Permission has been denied by the user');
}

var Notify = window.Notify.default;

function doNotification (nama,pesan,id) 
{
	var myNotification = new Notify(nama, {
		icon: 'http://www.pakpakbharatkab.go.id/imej/pakpaklogo.png',
		body: pesan,
		tag: id,
		notifyShow: onShowNotification,
		notifyClose: onCloseNotification,
		notifyClick: onClickNotification(),
		notifyError: onErrorNotification,
		timeout: 100
	});

	myNotification.show();
}

if (!Notify.needsPermission) {
	//doNotification();
	//doNotification('sam','limb pesan disini','12');
	//alert('');
} else if (Notify.isSupported()) {
	Notify.requestPermission(onPermissionGranted, onPermissionDenied);
}
//*********************notification********************************************//






function loading(disini)
{
	$(disini).html("<div id='loading'><center><span class='fa fa-spinner'></span> Loading...</center></div>");
	//$(disini).append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
	
	
}

function loading_hide(disini)
{
	$(disini).find("#loading").remove();
	
}

function eksekusi_controller(method)
{
	loading(".content-wrapper");
	
	document.title=method;
	
	$.get(url+method,function(e){
				
		$(".content-wrapper").html(e);
		loading_hide(".content-wrapper");
		
	})
	
	
	
	//notification in menu
	//notif_tbl_cuti_sakit();
	//notif_tbl_cuti_lain();
	//notif_tbl_dinas_luar();
	//notif_tbl_surat_ijin_keterangan();
	//notif_tbl_surat_sakit();
    //notif_tbl_cuti_tahunan();
}



//notification in menu
//notif_tbl_cuti_sakit();
//notif_tbl_cuti_lain();
//notif_tbl_dinas_luar();
//notif_tbl_cuti_tahunan();
//notif_tbl_surat_ijin_keterangan();
//notif_tbl_surat_sakit();


var nama_notif = "SIBAHANPE";

function notif_tbl_cuti_sakit()
{
	$.get(url+"index.php/notif/notif_tbl_cuti_sakit",function(e){
		
		if(e != "0")
		{
				
			$("#t4_notif_tbl_cuti_sakit").html(e);
			doNotification (nama_notif,e+" Permintaan Cuti Sakit",1);
		}
	})
}



function notif_tbl_cuti_lain()
{
	$.get(url+"index.php/notif/notif_tbl_cuti_lain",function(e){
		
		if(e != "0")
		{				
			$("#t4_notif_tbl_cuti_lain").html(e);
			doNotification (nama_notif,e+" Permintaan Cuti Alasan Penting",3);
		}
	})
}




function notif_tbl_cuti_tahunan()
{
	$.get(url+"index.php/notif/notif_tbl_cuti_tahunan",function(e){
		
		if(e != "0")
		{
			
		$("#t4_notif_tbl_cuti_tahunan").html(e);
		doNotification (nama_notif,e+" Permintaan Cuti Tahunan",4);
		}
	})
}




function notif_tbl_dinas_luar()
{
	$.get(url+"index.php/notif/notif_tbl_dinas_luar",function(e){
		
		if(e != "0")
		{
			
		$("#t4_notif_tbl_dinas_luar").html(e);
		doNotification (nama_notif,e+" Permintaan Dinas Luar",4);
		}
	})
}





function notif_tbl_surat_ijin_keterangan()
{
	$.get(url+"index.php/notif/notif_tbl_surat_ijin_keterangan",function(e){
		
		if(e != "0"){
			
		$("#t4_notif_tbl_surat_ijin_keterangan").html(e);
		doNotification (nama_notif,e+" Permintaan Ijin",5);
		}
	})
}



function notif_tbl_surat_sakit()
{
	$.get(url+"index.php/notif/notif_tbl_surat_sakit",function(e){
		
		if(e != "0")
		{	
			
		$("#t4_notif_tbl_surat_sakit").html(e);
		doNotification (nama_notif,e+" Permintaan Ijin Sakit",6);
		}
	})
}






function loading_cool(disini)            
{
	
	$(disini).after('<div class="overlay" id="loading_cool"><i class="fa fa-refresh fa-spin"></i></div>');
	
}

function loading_cool_hide(disini)            
{
	
	$(disini).next(".overlay").remove();
	
}


function hanya_alphanumeric(input)
{
	

	$(input).keypress(function (e) {
		var regex = new RegExp("^[a-zA-Z0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(str)) {
			return true;
		}

		e.preventDefault();
		return false;
	});
		
		
}



//firebase log
function set_log(id_admin, username, action, jam,callback) 
{
  firebase.database().ref('tbl_admin_log/').push({
    id_admin: id_admin,
    username: username,
    action 	: action,
    jam 	: jam
  });
  
  
  
  callback();
  
  
  
  
}

function baca_snap_log()
{
	
	
  //baca log
  
  
  //baca sekali
	firebase.database().ref('tbl_admin_log/').startAt().limitToLast(1).on("child_added", function(snap){
		
		snap.forEach(function(childSnapshot) { 
			var childKey = childSnapshot.key;
			var childData = childSnapshot.val();
				
				$("#t4_snap_log_admin").html('<i class="fa fa-warning text-yellow"></i> <b>'+childData.username+'</b> '+childData.action+' pada '+childData.jam);
				
				
		  });
	  
	}); 
		
	
  //baca saat ada perubahan
	firebase.database().ref('tbl_admin_log/').on("value", function(snap) {
	  
	  
	  snap.forEach(function(childSnapshot) { 
			var childKey = childSnapshot.key;
			var childData = childSnapshot.val();
				
				$("#t4_snap_log_admin").html('<i class="fa fa-warning text-yellow"></i> <b>'+childData.username+'</b> '+childData.action+' pada '+childData.jam);
				
				
		  });
	  
	}); 
  
}



















function admin_online(id_admin,username)
{
	
		
	/**********************************************user online***********************************/

	var presenceRef = firebase.database().ref('.info/connected');
	var tbl_admin_online = firebase.database().ref('tbl_admin_online/'); 


	var a = new Date(),
				date = a.getFullYear()+'-'+a.getMonth()+'-'+a.getDate()+' '+a.getHours()+':'+a.getMinutes()+':'+a.getSeconds();
			
	var aku 		= id_admin;	
	
	//browser info
	navigator.sayswho= (function(){
		var ua= navigator.userAgent, tem, 
		M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
		if(/trident/i.test(M[1])){
			tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
			return 'IE '+(tem[1] || '');
		}
		if(M[1]=== 'Chrome'){
			tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
			if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
		}
		M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
		if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
		return M.join(' ');
	})();
	
	// Add ourselves to presence list when online.
	presenceRef.on("value", function(snap) {
	  if (snap.val()) {
		
		tbl_admin_online.child(aku).set({'id_admin':id_admin,'username':username,'waktu':a.toString(),'koneksi':true,'info':navigator.sayswho});
		
		tbl_admin_online.child(aku).onDisconnect().remove();
		
		
	  }
	});

	// Number of online users is the number of objects in the presence list.
	tbl_admin_online.on("value", function(snap) {
	  console.log("# t4_jumlah_online of online admins = " + snap.numChildren());
	  
	  $("#t4_jumlah_online").html(snap.numChildren());
	  $("#t4_admin_online").html('<i class="fa fa-users text-aqua"></i> '+snap.numChildren()+' admin online');
	  
	  $("#t4_all_admin_online").html('');
	  
	  snap.forEach(function(childSnapshot) { 
			var childKey = childSnapshot.key;
			var childData = childSnapshot.val();
				
				console.log(childKey+"# Semua admin online " + childData.username );
				
				$("#t4_all_admin_online").append('<button class="btn btn-primary btn-sm btn-flat">'+childData.username+'</button>');
				
				
		  });
	  
	}); 


	/**********************************************user online***********************************/	
		

	
}



