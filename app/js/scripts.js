// 各エレメントを取得
var searchWord = document.getElementsByName("search_word")[0];
var display = document.getElementsByName("display")[0];
var offset = document.getElementsByName("offset")[0];
var tableBody = document.getElementsByName("pages")[0];

/**
 * @description 初期化
 */
window.onload = function () {
    if (searchWord.value) boldSearchWord(searchWord.value);
}

/**
 * @description ページリンクの検索文字強調
 * @param {String} word 文字
 */
const boldSearchWord = function (word) {
    Array.prototype.slice.call(tableBody.children).forEach(trElement => {
        var titleColumn = Array.prototype.slice.call(trElement.children)[2];
        titleColumn.childNodes[0].innerHTML = titleColumn.childNodes[0].innerHTML.replace(word, `<b>${word}</b>`);
    });
}

/**
 * @description ウィキペディアページ検索
 * @param {Object} event イベント
 */
const findWiki = function (event) {
    // URI構築
    var uri = `/?display=${display.value}`;

    if (searchWord.value) {
        uri = `${uri}&title=${searchWord.value}`;
    }

    offsetInt = new Number(offset.value);
    if (event.target.innerText.trim() == 'Previous') {
        uri = `${uri}&offset=${--offsetInt}`;
    } else if (event.target.innerText.trim() == 'Next') {
        uri = `${uri}&offset=${++offsetInt}`;
    }

    // ページ遷移
    window.location.href = uri;
}

// リスナー登録
document.getElementsByName("find").forEach(e => e.addEventListener('click', findWiki));