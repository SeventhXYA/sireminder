@extends('layout.master')

@push('plugin-styles')
    {{-- <link href="{{ asset('assets/plugins/fullcalendar/main.min.css') }}" rel="stylesheet" /> --}}
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-4">Daftar Rencana Kerja</h6>
                            <div id='external-events' class='external-events'>
                                @foreach ($rencanakerja as $rk)
                                    <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'
                                        style="background-color: {{ $rk->color }}">
                                        <div class='fc-event-main'>
                                            {{ $rk->start_date }},
                                            <?php
                                            $num_char = 10;
                                            $text = $rk->rencana;
                                            echo substr($text, 0, $num_char) . '...';
                                            ?>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div id='fullcalendar'></div>
                        </div>
                    </div>
                    <div class="modal fade" id="lihatRencana" tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="btn-close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col mb-3">
                                        <label class="form-label fw-bold">Tanggal
                                            Mulai Kegiatan</label>
                                        <input type="text" class="form-control" id="start_date" readonly
                                            style="background-color: #f5f5f5;" />
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label fw-bold">Tanggal
                                            Selesai Kegiatan</label>
                                        <input type="text" class="form-control" id="end_date" readonly
                                            style="background-color: #f5f5f5;" />
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label fw-bold">Rencana</label>
                                        <textarea class="form-control" id="rencana" maxlength="255" rows="8" readonly
                                            style="background-color: #f5f5f5;"></textarea>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label fw-bold">Lokasi</label>
                                        <input type="text" class="form-control" id="lokasi" readonly
                                            style="background-color: #f5f5f5;" />
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/fullcalendar/main.min.js') }}"></script> --}}
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
    <script>
        $(document).ready(function() {
            var calendar = $('#fullcalendar').fullCalendar({
                editable: false,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: '/kelolarencanakerja/events',
                displayEventTime: false,
                selectable: true,
                selectHelper: true,

                eventRender: function(event, element) {
                    element.css('background-color', event.color);
                },
                eventClick: function(event) {
                    $.get('/kelolarencanakerja/events/' + event.id, function(data) {
                        $('#exampleModalScrollableTitle').text('Detail Rencana Kerja');
                        $('#lihatRencana').modal('show');
                        $('#start_date').val(moment(data.start_date).format(
                            'YYYY-MM-DD HH:mm:ss'));
                        $('#end_date').val(moment(data.end_date).format(
                            'YYYY-MM-DD HH:mm:ss'));
                        $('#rencana').val(data.rencana);
                        $('#lokasi').val(data.lokasi);
                    });
                },
            });
        });
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
@endpush
