import {register} from '@shopify/web-pixels-extension';

register(({analytics}) => {
    analytics.subscribe('product_added_to_cart', (event) => {
        // Example for accessing event data
        const cartLine = event.data.cartLine;

        const cartLineCost = cartLine.cost.totalAmount.amount;

        const cartLineCostCurrency = cartLine.cost.totalAmount.currencyCode;

        const merchandiseVariantTitle = cartLine.merchandise.title;

        function generateId() {
            let id = '';
            while (id.length < 32) {
                id += Math.random().toString(36).substr(2);
            }
            return id.substr(0, 32);
        }

        const payload = {
            action: 'add_to_cart',
            shop: window.location.hostname.replace('.myshopify.com', ''),
            product: merchandiseVariantTitle,
            cart: cartLine,
            'event-id': generateId(),
            timestamp: new Date().toISOString(),
        };

        // Example for sending event to third party servers
        fetch('https://6c98-2001-ee0-4141-f310-2b78-a16f-f03d-2ca1.ngrok-free.app/track-event', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload),
            keepalive: true,
        });
    });
});
