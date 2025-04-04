(() => {
  // node_modules/@shopify/web-pixels-extension/build/esm/globals.mjs
  var EXTENSION_POINT = "WebPixel::Render";

  // node_modules/@shopify/web-pixels-extension/build/esm/register.mjs
  var register = (extend) => shopify.extend(EXTENSION_POINT, extend);

  // extensions/web-pixel/src/index.js
  register(({ analytics }) => {
    analytics.subscribe("product_added_to_cart", (event) => {
      const cartLine = event.data.cartLine;
      const cartLineCost = cartLine.cost.totalAmount.amount;
      const cartLineCostCurrency = cartLine.cost.totalAmount.currencyCode;
      const merchandiseVariantTitle = cartLine.merchandise.title;
      function generateId() {
        let id = "";
        while (id.length < 32) {
          id += Math.random().toString(36).substr(2);
        }
        return id.substr(0, 32);
      }
      const payload = {
        action: "add_to_cart",
        shop: "shop",
        product: merchandiseVariantTitle,
        cart: cartLine,
        "event-id": generateId(),
        timestamp: (/* @__PURE__ */ new Date()).toISOString(),
        event_name: event.name,
        event_data: {
          cartLineCost,
          cartLineCostCurrency,
          merchandiseVariantTitle
        }
      };
      fetch("https://c99f-42-113-128-32.ngrok-free.app/track-event", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(payload),
        keepalive: true
      });
    });
  });
})();
//# sourceMappingURL=web-pixel.js.map
