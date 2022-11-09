<label for="clientInitials">Client<br>
    <input type="text" id="clientInitials" value="<?php if(isset($_SESSION['clientData']['clientFirstname']) && isset($_SESSION['clientData']['clientLastname'])){echo substr($_SESSION['clientData']['clientFirstname'], 0, 1).$_SESSION['clientData']['clientLastname'];}?>" readonly>
</label><br>
<label for="reviewText">Review Text
    <textarea class="reviewText" name="reviewText" id="reviewText" rows="4" required></textarea>
</label>
<input type="submit" name="review" class="review" value="Submit Review">
<input type="hidden" name="action" value="review">
<input type="hidden" name="clientId" value="'.<?php if(isset($_SESSION['clientData']['clientId'])){echo $_SESSION['clientData']['clientId'];}
elseif(isset($clientId)){echo $clientId;}?>.'">
<input type="hidden" name="invId" value="'.<?php if(isset($invInfo['invId'])){echo $invInfo['invId'];}
elseif(isset($invId)){echo $invId;}?>.'">