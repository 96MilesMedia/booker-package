<div>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
        <tbody>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Party Name</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="name" type="text" id="name" v-model="name" required="true">
                        <label class="mdl-textfield__label" for="name">Party Name</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Contact Email</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="email" type="email" id="email" v-model="email" required="true">
                        <label class="mdl-textfield__label" for="email">Contact Email</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Contact Telephone</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="telephone" type="text" id="telephone" v-model="telephone" required="true">
                        <label class="mdl-textfield__label" for="telephone">Contact Telephone</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Party Size</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="size" type="text" id="size" pattern="-?[0-9]*(\.[0-9]+)?" v-model="size" required="true">
                        <label class="mdl-textfield__label" for="size">Party Size</label>
                        <span class="mdl-textfield__error">Input is not a number!</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Date of Booking</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input input-calendar" name="date" type="text" id="date" required="true" v-model="date">
                        <label class="mdl-textfield__label" for="date"></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Time of Booking</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield" id="time-tooltip">
                        <input class="mdl-textfield__input" name="time" type="text" id="time" v-model="time" required="true" :disabled="timeActive == false">
                        <label class="mdl-textfield__label" for="time"></label>

                        <a v-on:click="reloadDate()" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--mini-fab mdl-button--colored" id="new-booking" v-if="status == 'pending'" v-cloak>
                            <i class="material-icons">autorenew</i>
                        </a>

                        <div class="mdl-tooltip" data-mdl-for="time-tooltip" v-if="timeActive == false && (status == 'pending' || status == '')">
                            <span v-if="status == ''">Date must be set to choose time</span>
                            <span v-if="status == 'pending'">To change the time<br>press the reload date<br>button to the right of this field.</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr v-if="status" v-cloak>
                <td class="mdl-data-table__cell--non-numeric">Status</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="status" type="text" id="status" v-model="status" v-capitalize readonly="readonly">
                        <label class="mdl-textfield__label" for="status">Status</label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>