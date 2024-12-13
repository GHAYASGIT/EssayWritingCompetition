@extends('app.layout')

@section('title', 'Welcome')

@section('content')


<h5 class="mt-4">Events</h5>
<div class="row">
    <div class="col-md mb-4 mb-md-0">

        <small class="text-light fw-semibold">Ongoing Events</small>

        <div class="accordion mt-3" id="ongoingAccordionExample">
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#ongoingAccordionOne" aria-expanded="true" aria-controls="ongoingAccordionOne">
                        Accordion Item 1
                    </button>
                </h2>

                <div id="ongoingAccordionOne" class="accordion-collapse collapse" data-bs-parent="#ongoingAccordionExample">
                    <div class="accordion-body">
                        Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing
                        marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping
                        soufflé. Wafer gummi bears marshmallow pastry pie.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md">
        <small class="text-light fw-semibold">Upcomming Events</small>
        <div class="accordion mt-3" id="accordionExample">
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button
                    type="button"
                    class="accordion-button"
                    data-bs-toggle="collapse"
                    data-bs-target="#accordionOne"
                    aria-expanded="true"
                    aria-controls="accordionOne"
                >
                    Accordion Item 1
                </button>
                </h2>
    
                <div
                id="accordionOne"
                class="accordion-collapse collapse"
                data-bs-parent="#accordionExample"
                >
                <div class="accordion-body">
                    Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing
                    marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping
                    soufflé. Wafer gummi bears marshmallow pastry pie.
                </div>
                </div>
            </div>
        </div>    
    </div>
</div>


@endsection
