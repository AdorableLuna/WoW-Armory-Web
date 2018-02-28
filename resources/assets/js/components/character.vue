<template>
    <div class="character-container">

        <div class="character">
            <div class="character-wrapper">
                <div class="gear">
                    <div class="slots armor">
                        <div class="itemslots left">
                            <template v-for="slot in slotsLeft">
                                <div class="item">
                                    <div class="icon" v-bind:name="slot.name"></div>
                                    <div class="details">
                                        <span class="itemName"></span>
                                        <div class="itemStats">
                                            <span class="itemLvl"></span>
                                            <div class="socket">
                                                <div class="gem"></div>
                                                <div class="frame"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="itemslots right">
                            <template v-for="slot in slotsRight">
                                <div class="item">
                                    <div class="icon" v-bind:name="slot.name"></div>
                                    <div class="details">
                                        <span class="itemName"></span>
                                        <div class="itemStats">
                                            <span class="itemLvl"></span>
                                            <div class="socket">
                                                <div class="gem"></div>
                                                <div class="frame"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="slots weapons">
                        <div class="itemslots bottom">
                            <template v-for="slot in slotsBot">
                                <div class="item">
                                    <div class="icon" v-bind:name="slot.name"></div>
                                    <div class="details">
                                        <span class="itemName"></span>
                                        <div class="itemStats">
                                            <span class="itemLvl"></span>
                                            <div class="socket">
                                                <div class="gem"></div>
                                                <div class="frame"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <stats :stats="stats" :spec="spec"></stats>
                <talents :talents="talents" :spec="spec"></talents>
            </div>
        </div>

    </div>
</template>
<script>
    import _ from 'lodash';
    import Stats from './stats';
    import Talents from './talents';

    export default {
        name: 'character',
        props: ['character', 'spec', 'talents'],
        components: {
            Stats,
            Talents
        },
        data() {
            return {
                stats: stats,
                slotsLeft: [
                    { name: 'head' },
                    { name: 'neck' },
                    { name: 'shoulder' },
                    { name: 'back' },
                    { name: 'chest' },
                    { name: 'shirt' },
                    { name: 'tabard' },
                    { name: 'wrist' },
                ],
                slotsRight: [
                    { name: 'hands' },
                    { name: 'waist' },
                    { name: 'legs' },
                    { name: 'feet' },
                    { name: 'finger1' },
                    { name: 'finger2' },
                    { name: 'trinket1' },
                    { name: 'trinket2' },
                ],
                slotsBot: [
                    { name: 'mainHand' },
                    { name: 'offHand' },
                ],
                items: this.character[12]
            }
        },
        mounted() {
            var url = this.character[9];
            url = url.replace('avatar', 'main')
            $('#main').css('background-image', 'url(https://render-eu.worldofwarcraft.com/character/' + url + ')');

            for (var i in this.items)
            {
                if (i != 'averageItemLevel' && i != 'averageItemLevelEquipped')
                {
                    var icon = this.items[i].icon;
                    var itemname = this.items[i].name;
                    var itemlvl = this.items[i].itemLevel;
                    var quality = this.items[i].quality;
                    var enchant = this.items[i].tooltipParams.enchant; // ?
                    var gem = this.items[i].tooltipParams.gem0;

                    $('.icon').each(function() {
                        if (i == this.getAttribute('name'))
                        {
                            $(this).css('background-image', 'url(https://render-eu.worldofwarcraft.com/icons/56/' + icon + '.jpg)');
                            $(this).parent().find('.details').find('.itemName').text(itemname);
                            $(this).parent().find('.details').find('.itemLvl').text(itemlvl);

                            switch(quality) {
                                case 0:
                                    var color = '#9d9d9d';
                                    break;
                                case 1:
                                    var color = '#fff';
                                    break;
                                case 2:
                                    var color = '#1eff00';
                                    break;
                                case 3:
                                    var color = '#0081ff';
                                    break;
                                case 4:
                                    var color = '#c600ff';
                                    break;
                                case 5:
                                    var color = '#ff8000';
                                    break;
                                case 6:
                                    var color = '#e5cc80';
                                    break;
                                case 7:
                                    var color = '#0cf';
                                    break;
                            }

                            $(this).parent().find('.details').find('.itemName').css('color', color);
                            $(this).parent().css('border-color', color);

                            if (i != 'mainHand' && i != 'offHand')
                            {
                                if (gem)
                                {
                                    axios.get('https://eu.api.battle.net/wow/item/' + gem + '?locale=en_GB&apikey=mhdn4msq3r8h2vjtpagkasg89wnh7jan').then((res) => {
                                        $(this).parent().find('.details').find('.gem').css('background-image', 'url(https://render-eu.worldofwarcraft.com/icons/56/' + res.data.icon + '.jpg)');
                                        $(this).parent().find('.details').find('.frame').css('background-image', 'url("https://worldofwarcraft.akamaized.net/static/components/ItemSocket/ItemSocket-prismatic.png")');
                                    });
                                }
                            }
                        }
                    });
                }
            }
        }
    }
</script>