

//多分、いちいちinitしなくていい。

//イベントを使ってる。表示と値の取得の順番の為に書く
window.onload = function () {
	const useNodeJS = false;   // if you are not using a node server, set this value to false
	const defaultLiffId = '1657292332';   // change the default LIFF value if you are not using a node server
  const cloudfrontUrl = 'https://dev-ext-app.herokuapp.com/public/';

    //jQueryを使い、DOMの読み込みが完了したときに処理を実行
	$(document).ready(function () {
		initializeLiff(defaultLiffId);
	});
}

function initializeLiff(myLiffId) {
	liff
		.init({
			liffId: myLiffId
		})
		.then(() => {
			if (!liff.isLoggedIn()) {
				liff.login();
			} else {


  liff.getProfile().then(function (profile) {

    document.getElementById('displayNameField').textContent = profile.displayName;

    //valueに追加 fromのname.子要素のname.value
    document.getElementById('displayNameps').value =profile.displayName;
    const profilePictureDiv = document.getElementById('profilePictureDiv');
    if (profilePictureDiv.firstElementChild) {
      profilePictureDiv.removeChild(profilePictureDiv.firstElementChild);
    }

    //createElementで、新しいノード(要素)を作成！
    const img = document.createElement('img');
  /*
    if (!profile.pictureUrl) {
      //img→　HTMLImageElement.src　要素に表示する画像を指定
      img.src = `${cloudfrontUrl}/img/default.png`;
    } else {
      img.src = profile.pictureUrl;
      document.getElementById('urlps').value = profile.pictureUrl;
      
      //画像の大きさを変更
      img.setAttribute('width','30%');
     
    }
*/
    if (profile.pictureUrl != 'defined' && profile.pictureUrl != null) {
      //img→　HTMLImageElement.src　要素に表示する画像を指定
      img.src = profile.pictureUrl;
      document.getElementById('urlps').value = profile.pictureUrl;
      
      //画像の大きさを変更
      img.setAttribute('width','30%');
      
    img.alt = 'Profile Picture';
    profilePictureDiv.appendChild(img);
    }



    document.getElementById('statusMessageField').textContent = profile.statusMessage;
    //
    document.getElementById('statusMessageps').value = profile.statusMessage;
    $("body").css("display", "block");
    
    //getuserid
    document.getElementById('userIdProfileField').textContent = profile.userId;
    document.getElementById('userIdProps').value = profile.userId;

    //大橋さんの環境で、エラーが出てる。cloudなんとか


//動作環境取得

  document.getElementById('osField').textContent= liff.getOS();

  // 
   document.getElementById('osps').value= liff.getOS();

  document.getElementById('contextField').textContent= liff.getContext().type;
  //
  document.getElementById('conteps').value= liff.getContext().type;

  //Get idtoken

 // document.getElementById('idtoken').textContent=liff.getIDToken();
 // document.getElementById('displayNameField').value=liff.getIDToken();


}).catch(function (error) {
    window.alert('Error getting profile: ' + error);
  });
    

function getParam(name, url) {
//表示ページのURLを取得
if (!url) url = window.location.href;
name = name.replace(/[\[\]]/g, "\\$&").replace(/[()]/g, "");
var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
results = regex.exec(url);
if (!results) return null;
if (!results[2]) return '';
return decodeURIComponent(results[2].replace(/\+/g, " "));
}
  }})}
