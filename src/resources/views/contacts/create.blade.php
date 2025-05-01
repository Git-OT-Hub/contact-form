<div class="flash-message">
    @if(session('successMessage'))
        <div class="flash-message__success">
            {{ session('successMessage') }}
        </div>
    @elseif(session('failureMessage'))
        <div class="flash-message__danger">
            {{ session('failureMessage') }}
        </div>
    @endif
</div>
<h1>お問い合わせ入力ページ</h1>