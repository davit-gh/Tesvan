@extends("layouts.app")

@section('styles')

<link rel="stylesheet" type="text/css" href="/css/slick-theme.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/slick.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/qa.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/co-workers.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/customers.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/team.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/testiomanials.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/partners.css?v={{ strtotime(date('YmdHis')) }}">
<link rel="stylesheet" type="text/css" href="/css/contact_us.css?v={{ strtotime(date('YmdHis')) }}">
<style>
    .square_pt {
        padding: 36px 0;
    }

    .square_d {
        min-height: 315px;
    }
</style>
@endsection


@section('content')

@include('banner')

@include('qa')

@include('co-workers')

@include('partners')

@include('customers')

@include('team')

@include('testiomanials')

@include('contact_us')

@endsection

@section('scripts')

<script src="../js/blockRotate.js"></script>
<script src="../js/slick.js"></script>
<script src="../js/slick.min.js"></script>
<script src="../js/map.js"></script>
<script src="../js/customSlick.js"></script>
<script src="../js/home_validation.js"></script>
<script>
@if(Session::has('success'))
    $('#myModal').modal('show');
@endif

function boldBeforeColon(str) {
    var res = str.split(":");
    var mynewres = "<b>" + res[0] + ": " + "</b>" + res[1];
    var i = 2;
    var newres = mynewres;
    while (typeof res[i] !== 'undefined') {
        newres = newres + ":" + res[i];
        i++;
    }
    return newres;
}

$('.QA_text.hue_black').each(function () {
    $(this).html(boldBeforeColon($(this).text()));
})
</script>
<script type="text/javascript">
_linkedin_partner_id = "4320233";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
(function(l) {
if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
window.lintrk.q=[]}
var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})(window.lintrk);
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=4320233&fmt=gif" />
</noscript>
@endsection
