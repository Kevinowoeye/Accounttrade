<div class="w-[418px] max-w-full">
    {!! view_render_event('bagisto.shop.checkout.cart.summary.title.before') !!}

    <p
        class="text-2xl font-medium"
        role="heading"
    >
        @lang('shop::app.checkout.cart.summary.cart-summary')
    </p>

    {!! view_render_event('bagisto.shop.checkout.cart.summary.title.after') !!}

    <!-- Cart Totals -->
    <div class="mt-6 grid gap-4">
        <!-- Estimate Tax and Shipping -->
        <template v-if="cart.have_stockable_items">

            @include('shop::checkout.cart.summary.estimate-shipping')
            
        </template>

        <!-- Sub Total -->
        {!! view_render_event('bagisto.shop.checkout.cart.summary.sub_total.before') !!}

        <template v-if="displayTax.subtotal == 'including_tax'">
            <div class="flex justify-between text-right">
                <p class="text-base">
                    @lang('shop::app.checkout.cart.summary.sub-total')
                </p>

                <p class="text-base font-medium">
                    @{{ cart.formatted_sub_total_incl_tax }}
                </p>
            </div>
        </template>

        <template v-else-if="displayTax.subtotal == 'both'">
            <div class="flex justify-between text-right">
                <p class="text-base">
                    @lang('shop::app.checkout.cart.summary.sub-total-excl-tax')
                </p>

                <p class="text-base font-medium">
                    @{{ cart.formatted_sub_total_excl_tax }}
                </p>
            </div>
            
            <div class="flex justify-between text-right">
                <p class="text-base">
                    @lang('shop::app.checkout.cart.summary.sub-total-incl-tax')
                </p>

                <p class="text-base font-medium">
                    @{{ cart.formatted_sub_total_incl_tax }}
                </p>
            </div>
        </template>

        <template v-else>
            <div class="flex justify-between text-right">
                <p class="text-base">
                    @lang('shop::app.checkout.cart.summary.sub-total')
                </p>

                <p class="text-base font-medium">
                    @{{ cart.formatted_sub_total_excl_tax }}
                </p>
            </div>
        </template>

        {!! view_render_event('bagisto.shop.checkout.cart.summary.sub_total.after') !!}

        <!-- Discount -->
        {!! view_render_event('bagisto.shop.checkout.cart.summary.discount_amount.before') !!}

        <div 
            class="flex justify-between text-right"
            v-if="cart.discount_amount && parseFloat(cart.discount_amount) > 0"
        >
            <p class="text-base">
                @lang('shop::app.checkout.cart.summary.discount-amount')
            </p>

            <p class="text-base font-medium">
                @{{ cart.formatted_discount_amount }}
            </p>
        </div>

        {!! view_render_event('bagisto.shop.checkout.cart.summary.discount_amount.after') !!}

        <!-- Apply Coupon -->
        {!! view_render_event('bagisto.shop.checkout.cart.summary.coupon.before') !!}
        
        @include('shop::checkout.coupon')

        {!! view_render_event('bagisto.shop.checkout.cart.summary.coupon.after') !!}

        <!-- Shipping Rates -->
        {!! view_render_event('bagisto.shop.checkout.onepage.summary.delivery_charges.before') !!}
        
        <template v-if="displayTax.shipping == 'including_tax'">
            <div class="flex justify-between text-right">
                <p class="text-base">
                    @lang('shop::app.checkout.cart.summary.delivery-charges')
                </p>

                <p class="text-base font-medium">
                    @{{ cart.formatted_shipping_amount_incl_tax }}
                </p>
            </div>
        </template>

        <template v-else-if="displayTax.shipping == 'both'">
            <div class="flex justify-between text-right">
                <p class="text-base">
                    @lang('shop::app.checkout.cart.summary.delivery-charges-excl-tax')
                </p>

                <p class="text-base font-medium">
                    @{{ cart.formatted_shipping_amount_excl_tax }}
                </p>
            </div>
            
            <div class="flex justify-between text-right">
                <p class="text-base">
                    @lang('shop::app.checkout.cart.summary.delivery-charges-incl-tax')
                </p>

                <p class="text-base font-medium">
                    @{{ cart.formatted_shipping_amount_incl_tax }}
                </p>
            </div>
        </template>

        <template v-else>
            <div class="flex justify-between text-right">
                <p class="text-base">
                    @lang('shop::app.checkout.cart.summary.delivery-charges')
                </p>

                <p class="text-base font-medium">
                    @{{ cart.formatted_shipping_amount_excl_tax }}
                </p>
            </div>
        </template>

        {!! view_render_event('bagisto.shop.checkout.onepage.summary.delivery_charges.after') !!}

        <!-- Taxes -->
        {!! view_render_event('bagisto.shop.checkout.cart.summary.tax.before') !!}

        <div
            class="flex justify-between text-right"
            v-if="! cart.tax_total"
        >
            <p class="text-base max-sm:text-sm max-sm:font-normal">
                @lang('shop::app.checkout.cart.summary.tax')
            </p>

            <p class="text-lg font-semibold">
                @{{ cart.formatted_tax_total }}
            </p>
        </div>

        <div
            class="flex flex-col gap-2 border-y py-2"
            v-else
        >
            <div
                class="flex cursor-pointer justify-between text-right"
                @click="cart.show_taxes = ! cart.show_taxes"
            >
                <p class="text-base max-sm:text-sm max-sm:font-normal">
                    @lang('shop::app.checkout.cart.summary.tax')
                </p>

                <p class="flex items-center gap-1 text-base font-medium max-sm:text-sm max-sm:font-medium">
                    @{{ cart.formatted_tax_total }}
                    
                    <span
                        class="text-xl"
                        :class="{'icon-arrow-up': cart.show_taxes, 'icon-arrow-down': ! cart.show_taxes}"
                    ></span>
                </p>
            </div>

            <div
                class="flex flex-col gap-1"
                v-show="cart.show_taxes"
            >
                <div
                    class="flex justify-between gap-1 text-right"
                    v-for="(amount, index) in cart.applied_taxes"
                >
                    <p class="text-sm max-sm:text-sm max-sm:font-normal">
                        @{{ index }}
                    </p>

                    <p class="text-sm font-medium max-sm:text-sm max-sm:font-medium">
                        @{{ amount }}
                    </p>
                </div>
            </div>
        </div>

        {!! view_render_event('bagisto.shop.checkout.cart.summary.tax.after') !!}
   
        <!-- Cart Grand Total -->
        {!! view_render_event('bagisto.shop.checkout.cart.summary.grand_total.before') !!}

        <div class="flex justify-between text-right">
            <p class="text-lg font-semibold">
                @lang('shop::app.checkout.cart.summary.grand-total')
            </p>

            <p class="text-lg font-semibold">
                @{{ cart.formatted_grand_total }}
            </p>
        </div>

        {!! view_render_event('bagisto.shop.checkout.cart.summary.grand_total.after') !!}

        {!! view_render_event('bagisto.shop.checkout.cart.summary.proceed_to_checkout.before') !!}

        <a
            href="{{ route('shop.checkout.onepage.index') }}"
            class="primary-button mt-4 place-self-end rounded-2xl px-11 py-3"
        >
            @lang('shop::app.checkout.cart.summary.proceed-to-checkout')
        </a>

        {!! view_render_event('bagisto.shop.checkout.cart.summary.proceed_to_checkout.after') !!}
    </div>
</div>