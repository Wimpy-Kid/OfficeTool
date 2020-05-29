<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script>
        window.tk = {!! json_encode(['csrfToken' => csrf_token()]); !!}
    </script>
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <title>凡义午餐券</title>
</head>
<body>
    <div class="">
        <form id="user-list" action="{{ route("generate_ticket") }}" method="get" target="_blank">
            <table>
                @php
                    $each_line = 5;
                    $counter = 0;
                @endphp
                @foreach($users as $user)
                    @if( !($counter % $each_line) )
                        <tr>
                    @endif
                        @php
                        $style = $user->need_ticket?"":"background: gray;";
                        if ( isset($new_users[ $user->id ]) ) {
                            $style = "background: green;";
                        } elseif ($user->need_ticket) {
                            $style = "";
                        } else {
                            $style = "background: gray;";
                        }
                        @endphp
                        <td width="{{ 100/$each_line }}%" style="{{ $style }}">
                        <input class="checkbox" type="checkbox" id="user-{{ $user->id }}" name="users[]" value="{{ $user->id }}" {{ $user->need_ticket?"checked":"" }}>
                        <label for="user-{{ $user->id }}">{{ $user->name }}</label><br>
                        </td>
                    @if( ($counter % $each_line) == ($each_line - 1) )
                        </tr>
                    @endif
                    @php
                        $counter++;
                    @endphp
                @endforeach
                <input type="month" name="date" value="{{ date("Y-m", \Carbon\Carbon::now()->addMonth()->timestamp) }}">
                <input type="button" value="反选" id="select-anti">
                <input type="button" value="全选" id="select-all">
                <input type="submit" value="提交">
            </table>
        </form>

        <br><br><br>

        <form action="{{ route("lunch_ticket") }}" method="post">
            {{ csrf_field() }}
            姓名：<input type="text" name="username" placeholder="新成员名称"><br>
            <label for="need_ticket">给票：</label>
            <input type="radio" id="need_ticket" name="need_ticket" value="1" checked>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <label for="no_ticket">无票：</label>
            <input type="radio" id="no_ticket" name="need_ticket" value="0">
            <br />
            <input type="submit" value="添加新成员">
        </form>

    </div>
    <script type="text/javascript">

        let checkboxs = $("#user-list input[type=checkbox]");
        for (let i = 0; i < checkboxs.length; i++) {
            checkboxs[i].onchange = function () {
                this.parentElement.style.background = this.parentElement.style.background?"":"gray"
            };
        }

        $("#select-anti")[0].onclick = function () {
            let check_boxes = $('#user-list input[type=checkbox]');
            for( let i = 0; i < check_boxes.length; i++) {
                check_boxes[i].checked = !check_boxes[i].checked;
                check_boxes[i].parentElement.style.background = check_boxes[i].parentElement.style.background?"":"gray"
            }
        };

        $("#select-all")[0].onclick = function () {
            let check_boxes = $('#user-list input[type=checkbox]');
            for( let i = 0; i < check_boxes.length; i++) {
                check_boxes[i].checked = true;
                check_boxes[i].parentElement.style.background = "";
            }
        };
    </script>
</body>
</html>