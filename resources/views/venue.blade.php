@extends('layouts.app')

@section('content')
    <section class="hero is-small is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title" style="text-align:center;">
                    {{$venue->name}}
                </h1>
            </div>
        </div>
    </section>


    <div class="container">
        <div class="section">
            <div class="columns">
                {{--contact detail column--}}
                <div class="column">
                    <div class="box">
                        <h5 class="title is-5">Contact Details</h5>
                        <table class="table">
                            @if(isset($venue->contact) && isset($venue->contact->phone) && strlen($venue->contact->phone) > 0)
                                <tr>
                                    <td><b>Phone</b></td>
                                    <td>{{$venue->contact->phone}}</td>
                                </tr>
                            @endif
                            @if(isset($venue->location) && isset($venue->location->address) && strlen($venue->location->address) > 0)
                                <tr>
                                    <td><b>Address</b></td>
                                    <td>{{$venue->location->address}}</td>
                                </tr>
                            @endif

                        </table>

                    </div>
                </div>
                <div class="column">
                    <div class="box">
                        <h5 class="title is-5">Interesting Facts</h5>
                        <table class="table">
                            @if(isset($venue->price) && isset($venue->price->message) && strlen($venue->price->message) >0)
                                <tr>
                                    <td><b>Pricing</b></td>
                                    <td>{{$venue->price->message}}</td>
                                </tr>
                            @endif
                            @if(isset($venue->rating) && strlen($venue->rating) > 0)
                                <tr>
                                    <td><b>Rating</b></td>
                                    <td>{{$venue->rating}} / 10</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            @if($venue->photos && $venue->photos->groups)
                <h5 class="title is-5">Photos</h5>
                <div class="columns is-multiline">
                    @foreach($venue->photos->groups as $group)
                        @foreach($group->items as $item)
                            <div class="column is-one-third">
                                <figure class="image  is-square">
                                    <img src="{{ $item->prefix . $item->width . 'x' . $item->height . $item->suffix }}"
                                         alt="{{$item->id}}"
                                         name="venueImage">
                                </figure>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @endif

            @if($venue->tips && $venue->tips->groups)
                <h5 class="title is-5">Comments</h5>
                <div class="columns is-multiline">
                    @foreach($venue->tips->groups as $group)
                        @foreach($group->items as $item)
                            <div class="column is-half">
                                <div class="box">
                                    <article class="media">
                                        <div class="media-left">
                                            <figure class="image is-64x64">
                                                <img src="{{$item->user->photo->prefix.'64x64'.$item->user->photo->suffix}}">
                                            </figure>
                                        </div>
                                        <div class="media-content">
                                            <div class="content">
                                                <p>
                                                    <strong>{{$item->user->firstName}} {{isset($item->user->lastName) ? $item->user->lastName : ''}}</strong>
                                                    <br>
                                                    {{$item->text}}
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @endif

        </div>

    </div>

    <div class="modal" id="mdl_view_image">
        <div class="modal-background" name="mdl_view_image_close"></div>
        <div class="modal-content">
            <img src="#" id="mdl_view_image_imageElement">
        </div>
        <button class="modal-close is-large" name="mdl_view_image_close" aria-label="close"></button>
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('js/venue.js') }}"></script>
@endsection

