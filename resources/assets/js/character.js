window.Vue = require('vue');
window.axios = window.axios = require('axios');
window.$ = window.jQuery = require('jquery');

import Realms from './components/realms';
import Character from './components/character';

const app = new Vue({
    el: '#main',
    data: {
        realms: realms,
        character: character,
        background: background,
        spec: spec,
        talents: talents
    },
    components: {
        Realms,
        Character
    },
    methods: {
        filterRealms: function() {

            var input, filter, table, tr, td, i;
            input = document.getElementById("realm-name");
            filter = input.value.toUpperCase();
            table = document.getElementById("realms");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++)
            {
                td = tr[i].getElementsByTagName("td")[0];
                if (td)
                {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1)
                    {
                        tr[i].style.display = "";
                    }
                    else
                    {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
});
