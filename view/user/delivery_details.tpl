<!-- DELIVERY DETAILS -->
<section class="delivery-details container" id="delivery-details">
    <br><br><br>
    <h2 class="section__title">Delivery Details</h2>
    <div class="delivery-details__form">
        <form action="./index.php?controller=user&action=process_payment" method="post" class="delivery-details__create" id="delivery-details-form">
            <div class="delivery-details__box">
                <i class="bx bxs-user delivery-details__icon"></i>
                <input type="text" name="name" placeholder="Name and Surname" class="delivery-details__input" required>
            </div>
            <div class="delivery-details__box">
                <i class="bx bxs-home delivery-details__icon"></i>
                <input type="text" name="address_line1" placeholder="Address Line 1" class="delivery-details__input" required>
            </div>
            <div class="delivery-details__box">
                <i class="bx bxs-home delivery-details__icon"></i>
                <input type="text" name="address_line2" placeholder="Address Line 2" class="delivery-details__input">
            </div>
            <div class="delivery-details__box">
                <i class="bx bxs-city delivery-details__icon"></i>
                <input type="text" name="city" placeholder="City" class="delivery-details__input" required>
            </div>
            <div class="delivery-details__box">
                <i class="bx bxs-mailbox delivery-details__icon"></i>
                <input type="text" name="postal_code" placeholder="Postal Code" class="delivery-details__input" required>
            </div>
            <div class="delivery-details__box">
                <i class="bx bxs-world delivery-details__icon"></i>
                <input type="text" name="country" placeholder="Country" class="delivery-details__input" required>
            </div>
            <div class="delivery-details__box">
                <i class="bx bxs-phone delivery-details__icon"></i>
                <input type="tel" name="phone_number" placeholder="Phone Number" class="delivery-details__input" required>
            </div>
            <div class="delivery-details__box">
                <button type="submit" class="button">Proceed to Payment</button>
            </div>
        </form>
    </div>
</section>
<!-- END DELIVERY DETAILS -->
