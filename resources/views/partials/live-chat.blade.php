{{--
    Live chat widget (Tawk.to — free, no backend needed).

    Setup (one-time, ~2 minutes):
      1. Create a free account at https://www.tawk.to (Farrukh/the client's own email).
      2. In the dashboard: Administration → Channels → Chat Widget, copy the
         Property ID and Widget ID out of the embed snippet it gives you
         (a URL shaped like embed.tawk.to/<PROPERTY_ID>/<WIDGET_ID>).
      3. Set TAWKTO_PROPERTY_ID and TAWKTO_WIDGET_ID in the server's .env,
         then `php artisan config:clear`.
      4. Business hours (8am–5pm) are set on Tawk.to's side, not here:
         dashboard → Widget → Widget Content → Office Hours. Outside those
         hours the widget shows an offline message / leave-a-message form
         instead of "chat now".

    Renders nothing until both env vars are set, so it's safe to deploy
    before the account exists.
--}}
@if (config('services.tawkto.property_id') && config('services.tawkto.widget_id'))
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/{{ config('services.tawkto.property_id') }}/{{ config('services.tawkto.widget_id') }}';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
@endif
