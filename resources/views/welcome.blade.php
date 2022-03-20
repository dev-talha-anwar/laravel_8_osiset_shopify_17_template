@extends('vendor.shopify-app.layouts.default')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.css" integrity="sha512-X6069m1NoT+wlVHgkxeWv/W7YzlrJeUhobSzk4J09CWxlplhUzJbiJVvS9mX1GGVYf5LA3N9yQW5Tgnu9P4C7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        th,td{
            vertical-align: middle !important;
        }
        .bootstrap-tagsinput .tag{
            background-color:#00bcd4;
            padding: 2px;
            border-radius: 4px;
        }
        .pagination{
            justify-content: center;
        }
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        } 
        body {
            top: 0px !important; 
        }
        .goog-logo-link {
            display:none !important;
        }
        .goog-te-gadget {
        color: transparent !important;
        }
    </style>
    <script src="https://assets.flex.twilio.com/releases/flex-webchat-ui/2.9.1/twilio-flex-webchat.min.js" integrity="sha512-yBmOHVWuWT6HOjfgPYkFe70bboby/BTj9TGHXTlEatWnYkW5fFezXqW9ZgNtuRUqHWrzNXVsqu6cKm3Y04kHMA==" crossorigin></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20">
                <h4 class="c-grey-900 mB-20">
                    Inquiries 
                    <div id="google_translate_element"></div>

                    <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'en' , includedLanguages : 'en,it'}, 'google_translate_element');
                    }
                    </script>

                    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                </h4>
                <p>
                    {{-- Add <code class="highlighter-rouge">.table-hover</code> to enable a hover state on table rows within a <code class="highlighter-rouge">&lt;tbody&gt;</code>. --}}
                </p>
                {{ $inquiries->links() }}
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Message</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inquiries as $inquiry)    
                            <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                <td>{{ $inquiry->reason }}</td>
                                <td>{{ $inquiry->message }}</td>
                                <td>{{ $inquiry->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $inquiries->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        actions.TitleBar.create(app, { title: 'Inquiries' });
        $(function(){  
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
            @unless(auth()->user()->totalInquiries->count() > 0 && auth()->user()->plan_id == null) 
                const appConfig = {
                    accountSid:"{{ ENV('TWILIO_ACCOUNT_SID') }}",
                    flexFlowSid:"{{ ENV('TWILIO_FLEX_FLOW_SID') }}",
                    disableLocalStorage: true,
                    available: true,
                    flexWebChannelsUrl: "https://flex-api.twilio.com/v1/WebChannels",
                    context: {
                        friendlyName: "{{ auth()->user()->name }}"
                    },
                    startEngagementOnInit: false,
                    preEngagementConfig: {    
                        description: "Please provide some information",
                        fields: [
                            {
                                label: "My awesome dropdown",
                                type: "SelectItem",
                                attributes: {
                                    name: "reason",
                                    required: true,
                                    readOnly: false

                                },
                                options: [
                                    {
                                        value: "App",
                                        label: "App",
                                        selected: false
                                    },
                                    {
                                        value: "Theme",
                                        label: "Theme",
                                        selected: true
                                    },
                                    {
                                        value: "Payments",
                                        label: "Payments",
                                        selected: true
                                    },
                                    {
                                        value: "Shipping",
                                        label: "Shipping",
                                        selected: true
                                    },
                                    {
                                        value: "Sales Channels",
                                        label: "Sales Channels",
                                        selected: true
                                    },
                                    {
                                        value: "Social Media",
                                        label: "Social Media",
                                        selected: true
                                    },
                                    {
                                        value: "Increase Sales",
                                        label: "Increase Sales",
                                        selected: true
                                    },
                                    {
                                        value: "Other",
                                        label: "Other",
                                        selected: true
                                    },
                                ]
                            },
                            {
                                label: "Please Explain Your Reason",
                                type: "TextareaItem",
                                attributes: {
                                    name: "message",
                                    type: "text",
                                    placeholder: "Type your explain here",
                                    required: true,
                                    rows: 5
                                }
                            }
                        ],
                        submitLabel: "Submit",
                    },
                    componentProps: {
                        MessageCanvasTray: {
                            onButtonClick: () => { check() },
                        }
                    },         
                };
                Twilio.FlexWebChat.MessagingCanvas.defaultProps.predefinedMessage = false;
                // Twilio.FlexWebChat.renderWebChat(appConfig);
                Twilio.FlexWebChat.createWebChat(appConfig).then(webchat => {
                    const { manager } = webchat;
                    Twilio.FlexWebChat.Actions.on("beforeStartEngagement", (payload) => {
                        check()
                    });
                    Twilio.FlexWebChat.Actions.on("afterStartEngagement", (payload) => {
                        const { message } = payload.formData;
                        if (!message)
                            return;
                        const { channelSid } = manager.store.getState().flex.session;
                        manager.chatClient.getChannelBySid(channelSid).then(channel => channel.sendMessage(message));
                        let url = "{{ route('add') }}"
                        $.ajax({
                            url: `${url}`,
                            method: 'POST',
                            data: payload.formData,
                            success: function(res){
                            },
                        })
                    });
                    // Changing the Welcome message
                    manager.strings.WelcomeMessage = "Welcome";
                    // Render WebChat
                    webchat.init();
                })
                function check()
                {
                    let url = "{{ route('check') }}"
                    $.ajax({
                        url: `${url}`,
                        method: 'GET',
                        success: function(res){
                            if(!res.status){
                                $('#twilio-customer-frame > div > div > div.Twilio-RootContainer-default.css-wct8tc > button > div > div').click()
                                $('#twilio-customer-frame').remove();
                                location.reload()
                            }                        
                        },
                    })
                }
            @else
                Toast.fire({
                    icon: 'info',
                    title: 'Your Inquiry limit has been reached.Please Upgrade your plan.'
                })
            @endunless
        })
        
         
    </script>
@endsection