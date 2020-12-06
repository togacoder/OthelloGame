set encoding=utf-8
"No newline at end of file対策"
set binary noeol
" シンタックスハイライト "
syntax enable
" カラースキーム "
colorscheme elflord
" 行番号 "
set number relativenumber
" タイトルを表示 "
set title
" 不可視文字を表示 "
set list listchars=tab:>>,trail:-,eol:↲
" インデント "
set expandtab tabstop=4 softtabstop=4 shiftwidth=4
" cs go は除く "
autocmd BufNewFile,BufRead *.cs,*.go set noexpandtab
" yml, yamlファイルは除く "
autocmd BufNewFile,BufRead *.yml,*.yaml,Dockerfile set tabstop=2 softtabstop=2 shiftwidth=2
set smartindent
" 挿入モードでバックスペースで削除できるようにする "
set backspace=indent,eol,start
" 検索結果をハイライト表示 "
set hlsearch
" ハイライト消去 "
nnoremap <Esc><Esc> :nohlsearch<CR><ESC>
" 現在の行を強調表示 "
set cursorline
" 現在の列を強調表示 "
set cursorcolumn
" 対応する括弧を強調表示 "
set showmatch
" 文字コードをUTF-8"
set fenc=utf-8
" コメントの色 "
hi Comment ctermfg=2
" ヤンクでクリップボードにコピー "
set clipboard+=unnamed
" .cgiをperlとして読み込む "
autocmd BufRead, BufNewFile *.cgi setfiletype perl
" 音を消す "
set visualbell t_vb=
" 正規表現 "
nmap / /\v
" 右に開く"
set splitright
" 下に開く"
set splitbelow

" 括弧の入力 "
inoremap { {}<Left>
inoremap {<Enter> {<CR>}<Up><End><Enter>
inoremap {<BS> <Right><BS>
inoremap ( ()<LEFT>
inoremap (<Enter> (<CR>)<Up><End><Enter>
inoremap (<BS> <Right><BS>
inoremap [ []<LEFT>
inoremap [<Enter> [<CR>]<Up><End><Enter>
inoremap [<BS> <Right><BS>
inoremap " ""<LEFT>
inoremap ' ''<LEFT>

" 括弧
function! DeleteParenthesesAdjoin()
        let pos = col(".") - 1  " カーソルの位置．1からカウント
        let str = getline(".")  " カーソル行の文字列
        let parentLList = ["(", "[", "{", "\'", "\""]
        let parentRList = [")", "]", "}", "\'", "\""]
        let cnt = 0

        let output = ""

        " カーソルが行末の場合
        if pos == strlen(str)
                return "\b"
        endif
        for c in parentLList
                " カーソルの左右が同種の括弧
                if str[pos-1] == c && str[pos] == parentRList[cnt]
                        call cursor(line("."), pos + 2)
                        let output = "\b"
                        break
                endif
                let cnt += 1
        endfor
        return output."\b"
endfunction
" BackSpaceに割り当て
inoremap <silent> <BS> <C-R>=DeleteParenthesesAdjoin()<CR>
nnoremap <C-x> <C-v>

