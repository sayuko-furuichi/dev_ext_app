
//イベントを使ってる。表示と値の取得の順番の為に書く
window.onload = function () {
	const useNodeJS = false;   // if you are not using a node server, set this value to false
	const defaultLiffId = '1657185923-XNjWolQD';   // change the default LIFF value if you are not using a node server

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
    const profilePictureDiv = document.getElementById('profilePictureDiv');
    if (profilePictureDiv.firstElementChild) {
      profilePictureDiv.removeChild(profilePictureDiv.firstElementChild);
    }

    //createElementで、新しいノード(要素)を作成！
    const img = document.createElement('img');
    if (!profile.pictureUrl) {
      //img→　HTMLImageElement.src　要素に表示する画像を指定
      img.src = `${cloudfrontUrl}/img/default.png`
    } else {
      img.src = profile.pictureUrl;
    }
    img.alt = 'Profile Picture';
    profilePictureDiv.appendChild(img);
    document.getElementById('statusMessageField').textContent = profile.statusMessage;
    $("body").css("display", "block");
    document.getElementById('userIdProfileField').textContent = profile.userId;
  }).catch(function (error) {
    window.alert('Error getting profile: ' + error);
  });

}
/* function getParam(name, url) {
//表示ページのURLを取得
if (!url) url = window.location.href;
name = name.replace(/[\[\]]/g, "\\$&").replace(/[()]/g, "");
var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
results = regex.exec(url);
if (!results) return null;
if (!results[2]) return '';
return decodeURIComponent(results[2].replace(/\+/g, " "));
*/

