@extends('app')
@section('content')
    @widget('aside', ['page' => 'pre'])
    <div class="page_content">
        <style>
            .add_btn{display: table;
                padding: 10px 20px;
                background: #2572fa;
                color: #fff;
                border-radius: 4px;
                font-size: 15px;margin-left: 12px;    position: absolute;
                top: 30px;
                right: 40px;}

            .index_tabs{display: table;margin-top: 15px;}
            .index_tabs .index_tab{cursor: pointer;margin-right: 25px;display: inline-block;font-size: 15px;margin-bottom: -3px;padding-bottom: 10px;color: #1a73e8;}
            .index_tabs .index_tab.active{border-bottom: 3px solid #537ad6;}
        </style>
        <div class="main_block" style="position: relative">
            <h1 class="page_title">Заявки</h1>
        </div>
        <style>
            table {border-collapse: collapse;width: 100%;font-size: 16px;background: #fff;}
            table, th {border-bottom: 1px solid #ddd;}
            th{
                overflow: hidden;
                text-overflow: ellipsis;    white-space: nowrap;
                font-size: 15px;}
            tr{border-bottom: 1px solid #ddd;}
            tr:last-child{border-bottom: 0}
            th, td{padding: 10px 20px;border-right: 1px solid #ddd}
            th:last-child, td:last-child{border-right: 0}
            thead{border-collapse: separate;}
            thead th{padding: 15px 20px;}
            tbody{border-collapse: separate;}
            td{border-right: 1px solid #ddd}
            td:first-child{padding-left: 20px}
            td:last-child{padding-right: 20px;}
            .td_id{border-right: 1px solid #ddd;width: 75px;text-align: center}



            th input{width: 100%;padding: 8px 16px;border: 1px solid #ddd;border-radius: 10px}
            tr:nth-child(2n) {background:#f8fafc;}
            .btn_show_phone{display: table;background: #ffffff;border-radius: 25px;color: #222;padding: 2px 8px;border: 1px solid #bbb;}


            .td_sort{width:50px;max-width:50px;text-align:center}
            .td_image{max-width: 85px;min-width: 85px;width: 85px;}
            .th_search{padding: 0}
            .th_search_input{border: none;overflow: hidden;text-overflow: ellipsis;font-size: 15px;width: 100%;padding: 15px 20px;}
            .th_search_label{position: relative}
            .th_search_input_text{color: #222;font-weight: 700;top: 50%;transform: translateY(-50%);position: absolute;left: 20px;}
            .th_search_input_text i {
                margin-right: 6px;
                font-size: 13px;
            }
            .td_acts{padding-left: 20px;    width: 10%;text-align: right;white-space: nowrap}
            .td_acts button{width: 100%;background: #bbb;color: #fff;padding: 6px 14px;border-radius: 4px;}


            .item_sort i{color:#537ad6}
            .item_content .title {
                font-weight: 600;
            }
            .item_content .title_bottom {

                display: flex;
                flex-direction: column;
                color: #666;
                gap: 2px;
                line-height: 1.25;
            }
            .item_content .title_dop {
                font-size: 12px;
                font-weight: 700;
            }
            .item_content .title_dop span {
                font-weight: 400;
                margin-left: 4px;
            }


            .item_price_wrap{display: flex;
                align-items: end;white-space: nowrap;
                gap: 8px;}
            .item_price{font-size: 15px;
                font-weight: 500;}
            .item_price2{    font-size: 13px;
                text-decoration: line-through;
                color: #999;}

            .item_sale{font-size:12px;line-height:1;color: #222;display: flex;margin-top: 4px;font-weight: 300}
            .item_sale_wrap{border-radius:4px;display: flex;overflow: hidden;border: 1px solid #ffd600}
            .item_sale_percent{padding:4px 6px;background: #ffd600;}
            .item_sale_sum{padding:4px 6px;background: #fff8db;}

            .pre_td{display: flex;flex-direction: column;gap: 10px;padding: 10px 0}
        </style>

        <form action="" id="update_clients" method="GET">
        </form>
        <div class="main_block" style="padding: 0">
            <table>
                <thead>
                <tr>
                    <th class="th_search">
                        <label class="th_search_label">
                            <input class="th_search_input js_find" type="text">
                            <span class="th_search_input_text"><i class="far fa-search"></i>Название</span>
                        </label>
                    </th>
                    <th>Клиент</th>
                    <th>Статус</th>
                    <th class="td_acts"></th>
                </tr>
                </thead>
                <tbody class="js_html">
                @include('pre.items')
                </tbody>
            </table>
        </div>
    </div>

@endsection
