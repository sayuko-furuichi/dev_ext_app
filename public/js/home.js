const lang = getParam('lang');
const defaultLang = 'ja';
const supportedLangList = ['ja']
const cloudfrontUrl = 'https://dev-linemn.herokuapp.com/public/'

window.onload = function () {
  const useNodeJS = false;   // if you are not using a node server, set this value to false
  const defaultLiffId = '1657185923-XNjWolQD';   // change the default LIFF value if you are not using a node server

  //ペーじが出来上がったら、liffIDを渡してinitさせる
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
        // start to use LIFF's api
        // initializeApp();

        //ja.jsonのやつ
        let jsonPath = ''
        if (supportedLangList.indexOf(lang) >= 0) {
          jsonPath = 'lang/' + lang + '.json';
        } else {
          jsonPath = 'lang/' + defaultLang + '.json';
        }
        let glot = new Glottologist();
        glot.import(jsonPath).then(() => {
          glot.render();
        });


        //init完了後、LIFFアプリ起動。

        //渡したprofileに、getProfile()のJSON形式で入っている。そっから、profile.***で持ってくるだけ。phpなら、$profile　->***　ですな
        liff.getProfile().then(function (profile) {
          //textContent -> ノードおよびその子孫のテキストの内容を表します。
          //　https://developer.mozilla.org/ja/docs/Web/API/Node/textContent

          //指定したidがあるノードを取得して、そこに代入
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
        }).catch(function (error) {
          window.alert('Error getting profile: ' + error);
        });
      }
    })
    .catch((err) => {
      alert('err:' + err);
    });
}

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