/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/message.js ***!
  \*********************************/
// 最初の HTML 文書の読み込みと解析が完了した時点で発生するイベント
window.addEventListener('DOMContentLoaded', function () {
  var submit = document.getElementById("submit");
  var el = document.getElementById('messages');
  var messageable_id = document.getElementById("messageable_id").value;
  // メッセージが増えた際に最新のメッセージを表示するために、スクロールを最下部に移動
  el.scrollTop = el.scrollHeight;
  // submitが押されたら発生するイベント
  submit.addEventListener('click', function () {
    var message = document.getElementById("message");
    // 非同期でPOST送信をするHTTP Clientライブラリのaxios
    axios.post("/entries/".concat(messageable_id, "/messages"), {
      messageable_id: messageable_id,
      message: message.value
    });
    // メッセージを送信後に、メッセージ入力欄を空にする
    message.value = '';
  });
  // 発生したMessageSendイベントを受け取ったら処理する
  window.Echo["private"]("Campus.".concat(messageable_id)).listen('MessageSend', function (e) {
    var current_user_id = document.getElementById('current_user_id').value;
    // ISO 8601の時間表記から日本の時間を取得する
    var date = new Date(e.message.created_at);
    var ja_date = date.toLocaleString("ja-JP", {
      hour: "numeric",
      minute: "numeric"
    });
    // メッセージ用のHTMLを作成するために、divタグの要素を作成する 実行結果: <div></div>
    var newDiv = document.createElement('div');
    // クラスを追加する 実行結果: <div class="chat-message"></div>
    newDiv.className = 'chat-message';
    // 現在のユーザーidと、イベントから渡されたユーザーidが一致したら処理する
    if (current_user_id == e.message.user_id) {
      // 右側にメッセージを表示するHTMLを<div class="chat-message"></div>の中に追加する。
      newDiv.innerHTML = "\n                    <div class=\"flex items-end justify-end\">\n                        <button class=\"delete-button\" id=\"".concat(e.message.id, "\" type=\"button\">\n                            <svg class=\"w-6 h-6 text-gray-600 pointer-events-none\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\">\n                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" \n                                    d=\"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16\">\n                                </path>\n                            </svg>\n                        </button>\n                        <div class=\"text-gray-600 text-sm\">").concat(ja_date, "</div>\n                        <div class=\"flex flex-col space-y-2 text-lg max-w-lg mx-2 items-end\">\n                            <div>\n                                <span class=\"px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white\">").concat(e.message.message, "</span>\n                            </div>\n                        </div>\n                        <img class=\"w-6 h-6 rounded-full\" src=\"").concat(e.message_send_user.profile_photo_url, "\" \n                            alt=\"").concat(e.message_send_user.name, "\" />\n                    </div>\n                ");
      // 親要素の子要素の最後にHTML追加
      el.appendChild(newDiv);
      // 追加した要素に削除用のイベントを追加
      var delete_button = document.getElementById(e.message.id);
      delete_button.addEventListener('click', deleteMessage, false);
      // 相手のメッセージの場合に処理
    } else {
      // 左側にメッセージを表示するHTMLを<div class="chat-message"></div>の中に追加する。
      newDiv.innerHTML = "\n                    <div class=\"flex items-end\">\n                        <img class=\"w-6 h-6 rounded-full\" src=\"".concat(e.message_send_user.profile_photo_url, "\" \n                            alt=\"").concat(e.message_send_user.name, "\" />\n                        <div class=\"flex flex-col space-y-2 text-lg max-w-lg mx-2 items-start\">\n                            <div>\n                                <span class=\"px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600\">").concat(e.message.message, "</span>\n                            </div>\n                        </div>\n                        <div class=\"text-gray-600 text-sm\">").concat(ja_date, "</div>\n                    </div>\n                ");
      // 親要素の子要素の最後にHTML追加
      el.appendChild(newDiv);
    }
    // メッセージを表示するために、スクロールを最下部に移動
    el.scrollTop = el.scrollHeight;
  });
});
var delete_buttons = document.querySelectorAll('.delete-button');

// 削除ボタンに削除用のイベントを追加する
for (var i = 0; i < delete_buttons.length; i++) {
  delete_buttons[i].addEventListener('click', deleteMessage, false);
}
function deleteMessage(e) {
  var message_id = e.target.id;
  var message_el = e.target.parentNode.parentNode;
  var csrf = document.head.querySelector('[name="csrf-token"]').content;
  // 非同期でDELETE送信をするHTTP Clientライブラリのaxios
  axios["delete"]("/entries/".concat(messageable_id, "/messages/").concat(message_id));
  // メッセージのHTMLを削除する
  message_el.remove();
}
/******/ })()
;