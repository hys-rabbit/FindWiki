<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Find Wiki!!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css" />
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="uk-container">
        <header>
            <a href="/"><img src="assets/logo.png"></a>
        </header>

        <!-- 入力ブロック -->
        <div class="uk-margin input">
            <div class="uk-form-controls">
                <input name="search_word" class="uk-input" type="text" placeholder="検索文字を入力してください" value="<?php echo $title?>">
            </div>
        </div>

        <div class="uk-margin input">
            <div class="uk-form-controls">
                <select name="display" class="uk-select">
                    <option value="50"  <?php echo $display == '50'  ? 'selected' : '' ?>>50</option>
                    <option value="100" <?php echo $display == '100' ? 'selected' : '' ?>>100</option>
                    <option value="200" <?php echo $display == '200' ? 'selected' : '' ?>>200</option>
                    <option value="500" <?php echo $display == '500' ? 'selected' : '' ?>>500</option>
                </select>
            </div>
        </div>

        <div class="uk-margin input">
            <button name="find" class="uk-button uk-button-default" type="button"><img src="assets/search_icon.png" alt="絞り込み" /></button>
        </div>

        <div class="uk-margin input">
            <label class="uk-form-label" for="form-stacked-select">検索結果</label>
            <b><?php echo $amount ?></b>
        </div>

        <input name="offset" type="hidden" value="<?php echo $offset ?>" />

        <!-- ページングアイコン（上段） -->
        <ul class="uk-pagination">
            <li>
                <?php if ($prev) { ?>
                    <a name="find" href="javascript:void(0);"><span class="uk-margin-small-right" uk-pagination-previous></span> Previous </a>
                <?php } ?>
            </li>
            <li class="uk-margin-auto-left">
                <?php if ($next) { ?>
                    <a name="find" href="javascript:void(0);"> Next <span class="uk-margin-small-left" uk-pagination-next></span></a>
                <?php } ?>
            </li>
        </ul>

        <!-- 結果表示テーブル -->
        <table class="uk-table uk-table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>名前空間</th>
                    <th>タイトル</th>
                </tr>
            </thead>
            <tbody name="pages">
            <?php $no = $offset * $display ?>
            <?php foreach ($pageEntityArray as $pageEntity) { ?>
                <tr>
                    <td><?php echo ++$no ?></td>
                    <td><?php echo empty($pageEntity->namespace) ? "-" : $pageEntity->namespace ?></td>
                    <td><a href="https://ja.wikipedia.org/wiki/<?php echo "{$pageEntity->namespace}:{$pageEntity->title}"?>" target="_blank">
                        <?php echo $pageEntity->title ?>
                    </a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <!-- ページングアイコン（下段） -->
        <ul class="uk-pagination">
            <li>
                <?php if ($prev) { ?>
                    <a name="find" href="javascript:void(0);"><span class="uk-margin-small-right" uk-pagination-previous></span> Previous </a>
                <?php } ?>
            </li>
            <li class="uk-margin-auto-left">
                <?php if ($next) { ?>
                    <a name="find" href="javascript:void(0);"> Next <span class="uk-margin-small-left" uk-pagination-next></span></a>
                <?php } ?>
            </li>
        </ul>
    </div>

    <!-- スクリプト -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <script typt="text/javascript" src="js/scripts.js"></script>
</body>
</html>