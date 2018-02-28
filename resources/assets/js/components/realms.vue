<template>
    <div class="servers-container">
        <div class="servers">

            <h1>Choose a server</h1>

            <div class="input">
                <div class="input-group">
                    <input type="text" id="realm-name" v-model="specifiedRealm" v-on:keyup="filterRealms" placeholder="Realm name">
                </div>

                <div class="input-group">
                    <input type="text" id="character-name" v-model="characterName" placeholder="Character name">
                </div>

                <div class="button-group">
                    <button id="search" v-on:click="searchCharacter">Search</button>
                </div>
            </div>

            <div class="table-container">
                <table id="realms">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>PvP</th>
                            <th>RP</th>
                            <th>Region</th>
                            <th>Time Zone</th>
                            <th>Alliance</th>
                            <th>Horde</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="realm in allRealms" v-on:click="selectRealm(realm.name)">
                            <td>{{ realm.name }}</td>
                            <td>{{ realm.stats.pvp }}</td>
                            <td>{{ realm.stats.rp }}</td>
                            <td>{{ realm.stats.region }}</td>
                            <td>{{ realm.stats.region }}</td>
                            <td>{{ realm.counts.Alliance }}</td>
                            <td>{{ realm.counts.Horde }}</td>
                            <td>{{ realm.counts.Alliance + realm.counts.Horde }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
    import _ from 'lodash';

    export default {
        name: 'realms',
        props: ['realms'],
        data() {
            return {
                specifiedRealm: null,
                characterName: null,
                allRealms: this.realms
            }
        },
        computed: {
            inputFields() {
                return this.specifiedRealm && this.characterName;
            }
        },
        watch: {
            inputFields(value) {
                if (value)
                {
                    document.getElementById('search').style.cursor = 'pointer';
                    document.getElementById('search').style.backgroundColor = '#2196F3';
                    document.getElementById('search').style.color = '#FFF';
                }
                else
                {
                    document.getElementById('search').style.cursor = 'not-allowed';
                    document.getElementById('search').style.backgroundColor = '#DFDFDF';
                    document.getElementById('search').style.color = '#9F9F9F';
                }
            }
        },
        methods: {
            filterRealms() {
                this.allRealms = _.filter(this.realms, (realm) => {
                    return _.lowerCase(realm.name).indexOf(_.lowerCase(this.specifiedRealm)) !== -1;
                });
            },
            selectRealm(name) {
                this.specifiedRealm = name;
                this.filterRealms();
            },
            searchCharacter() {
                this.specifiedRealm = this.specifiedRealm.replace(' ', '-');

                if (this.specifiedRealm && this.characterName)
                {
                    window.location.href = window.location.href + '/' + _.toLower(this.specifiedRealm) + '/' + _.toLower(this.characterName);
                }
            }
        }
    }
</script>