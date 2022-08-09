
@extends('layouts.mail')

@section('recipient')
    Dear {{$data['username']}}
@endsection




@section('content')

    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; color: #3f5db3; font-size: 14px; vertical-align: top; margin: 0; padding: 10px 10px;" valign="top">

            Thanks for registring with us, Please click the below link to activate your account.
        </td>
    </tr>
    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; color: #3f5db3; font-size: 14px; vertical-align: top; margin: 0; padding: 10px 10px;" valign="top">
            Click <a href="{{URL::to('/')}}/auth/verify?code={{$data['verification_code']}}">here</a> to activate your account.
            <br><br>

        </td>
    </tr>

@endsection












