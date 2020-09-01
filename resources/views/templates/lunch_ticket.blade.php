<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <style type="text/css">
        .border {
            border: 1px;
            border-style: dotted;
        }
        span {
            font-size: 9px;
        }
        .container {
            page-break-after: always;
        }
        .seal {
            width: 150px;
            position: absolute;
            padding-left: 170px;
            padding-top: 35px;
        }
    </style>
</head>
<body>

    <div>
        @php
            $each_line = 4;
        @endphp
        @for( $j = 0; $j < count($users); $j++)
            @php
                $counter = 0;
                $date_ = \Carbon\Carbon::createFromTimestamp(strtotime($date))->startOfMonth();
            @endphp
        <div class="container">

            <table class="" cellpadding="0 5 0 5">
            @for( $i = 0; $i < date('t', strtotime($date)); $i++)
                @if(($date_->isWeekend() && !in_array($date_->toDateString(), $special_days[2]["date"])) || in_array($date_->toDateString(), $special_days[1]["date"]))
                    @php
                        $date_ = $date_->addDay();
                    @endphp
                    @continue
                @endif
                @if( !($counter % $each_line) )
                    <tr class="border">
                @endif
                    <td class="border">
                        @if( ($counter+1)%2 == 1 && (($counter+1) / $each_line) % 2 == 0 )
                            <img class="seal" style="transform: rotate({{rand(-90, 90)}}deg); transform-origin: {{ 75 + rand(-1, 1) }}% {{ 60 + rand(-1, 1) }}%;" src="{{ asset("images/seal.png") }}" >
                        @endif
                        <table style="border: 0">
                            <tr>
                                <td rowspan="4" width="20%">
                                    <img style="width:55px;padding-right: 10px;" src="{{ asset("images/ticket-icon.png") }}">
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><span>广州凡义科技信息咨询有限公司</span></td>
                            </tr>
                            <tr>
                                <td><center style="font-size: 20px; font-weight: 600;">午餐券&nbsp;&nbsp;&nbsp;&nbsp;</center></td>
                            </tr>
                            <tr>
                                <td>
                                    <span>一人一券&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 当日有效</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <center>
                                        <span>员工：{{ $users[$j]->name }}</span>
                                        <span>
                                        日期：{{ $date_->toDateString() }}
                                    </span>
                                    </center>
                                </td>
                            </tr>
                        </table>

                    </td>
                @if( ($counter % $each_line) == ($each_line - 1) )
                    </tr>
                @endif
                @php
                    $date_ = $date_->addDay();
                    $counter++;
                @endphp
            @endfor
            </table>
        </div>
        @endfor
    </div>

</body>
</html>