
@extends('layouts.mail')

@section('recipient')
    Dear {{$data['name']}}
@endsection




@section('content')

    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; color: #3f5db3; font-size: 14px; vertical-align: top; margin: 0; padding: 10px 10px;" valign="top">

            Thanks for showing intrest in our services, we have received you inquiry,Our team will connect with you soon to get the detail requirments.
        </td>
    </tr>
    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 10px 10px;" valign="top">
            We may need to send you critical information about our service and it is important that we have an accurate email address.
            <br><br>
            <small>
                {{$data['message']}}
            </small>
        </td>
    </tr>

@endsection












