    <!-- list start -->
    <div id="con">
        <table border="1">
            <tr>
                <td>用户名</td>
                <td>E-mail</td>
                <td>评论等级</td>
                <td>评论内容</td>
            </tr>
            @foreach($comment as $v)
            <tr>
                <td>{{$v->name}}</td>
                <td>{{$v->email}}</td>
                <td>{{$v->order}}</td>
                <td>{{$v->desc}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" align="center">{{$comment->links()}}</td>
            </tr>
        </table>
    </div>
    <!-- list end -->