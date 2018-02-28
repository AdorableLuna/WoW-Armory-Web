<template>
    <div class="talents-container">

        <div class="talents">

            <div class="talents-container">

                <div class="talents-header">
                    <span class="talents-header-title">TALENTS</span>
                    <div class="talents-header-spec">
                        <span>Choose a Specialization</span>
                        <div class="talents-header-spec-icons" v-for="talents in allstalents" v-if="talents['spec']" v-on:click="changeSpec(talents['spec']['name'])" v-bind:style="{ 'opacity': ((talents['spec']['name'] == activespec[0]['spec']['name']) ? '1' : '0.4'), 'background-image': `url(https://render-eu.worldofwarcraft.com/icons/56/${ talents['spec']['icon'] }.jpg)` }"></div>
                    </div>
                </div>

                <div class="talents-details">
                    <div class="talents-description">
                        <div class="talents-description-text">
                            <div class="talents-description-text-header">
                                <div class="talents-description-text-icon" v-bind:style="{ 'background-image': `url(https://render-eu.worldofwarcraft.com/icons/56/${ activespec[0]['spec']['icon'] }.jpg)` }"></div>
                                <div class="talents-description-text-spec">
                                    <span>{{ activespec[0]['spec']['name'] }}</span>
                                </div>
                            </div>
                            <div class="talents-description-text-body">
                                <span>{{ activespec[0]['spec']['description'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="talents-tree">
                        <div class="talents-tree-text">
                            <div class="talents-tree-row" v-for="(talent, index) in tiertalents">
                                <div class="talents-tree-row-lvl" v-bind:style="{ 'padding-right':  (15 * (index + 1) == 105) ? '21px' : ''}">{{ (15 * (index + 1) == 105) ? 100 : 15 * (index + 1) }}</div>
                                <div class="talents-tree-row-talent">
                                    <div class="talents-tree-row-talent-icon" v-bind:style="{ 'background-image': `url(https://render-eu.worldofwarcraft.com/icons/56/${ talent['spell']['icon'] }.jpg)` }"></div>
                                    <div class="talents-tree-row-talent-name">{{ talent['spell']['name'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</template>
<script>
    import _ from 'lodash';

    export default {
        name: 'talents',
        props: ['talents', 'spec'],
        data() {
            return {
                allstalents: this.talents[12],
                activespec: this.talents[12].filter(spec => spec.selected),
                tiertalents: _.sortBy(this.talents[12].filter(spec => spec.selected)[0]['talents'], 'tier')
            }
        },
        updated: function() {
            Vue.nextTick(() => {
                var height = $('.talents-description').outerHeight();
                $('.talents-tree').css('max-height', height);
            });
        },
        methods: {
            changeSpec(name) {
                for (var i = 0; i < this.allstalents.length; i++)
                {
                    if (this.allstalents[i]['spec'])
                    {
                        if (this.allstalents[i]['spec']['name'] == name)
                        {
                            this.activespec[0] = this.allstalents[i];
                            this.tiertalents = _.sortBy(this.allstalents[i]['talents'], 'tier');
                            break;
                        }
                    }
                }
            }
        },
        mounted() {
            var height = $('.talents-description').outerHeight();
            $('.talents-tree').css('max-height', height);
        }
    }
</script>