@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('page-style')

@stop
@push('after-styles')
    <link rel="stylesheet" href="{{asset('assets/fullcalendar/lib/main.css')}}">

    <style>
        #calendar{
            color:#000 !important;
        }

        /*.fc .fc-event {
            border: 0;
            color: #000000 !important;
        }*/
    </style>
@endpush
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Stater</strong> page</h2>
            </div>
            <div class="body">
                <div style="color: #0D0A0A" class="" id="calendar">
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('page-script')
    <script src="{{asset('assets/fullcalendar/lib/locales-all.js')}}"></script>
    <script src="{{asset('assets/plugins/momentjs/moment.js')}}"></script>
    <script src="{{asset('assets/fullcalendar/lib/main.js')}}"></script>

@stop
@push('after-scripts')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale:'es',
                initialView: 'dayGridMonth',
                initialDate: '2020-08-12',
                eventColor: 'green',
                events: [
                    {
                        title: 'All Day Event',
                        start: '2020-08-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2020-08-07',
                        end: '2020-08-10',
                        color: 'purple' // override!
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: '2020-08-09T16:00:00'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: '2020-08-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2020-08-11',
                        end: '2020-08-13',
                        color: 'purple' // override!
                    },
                    {
                        title: 'Meeting',
                        start: '2020-08-12T10:30:00',
                        end: '2020-08-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2020-08-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2020-08-12T14:30:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2020-08-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2020-08-28'
                    },
                    {
                        title:'Prueba Campeon',
                        start: '2020-08-08 12:30:00',
                        end: '0000-00-00 00:00:00'
                    }
                ],
                eventClick:function(info){
                    console.log(info.event);
                }
            });


            calendar.render();
        });

    </script>
@endpush
