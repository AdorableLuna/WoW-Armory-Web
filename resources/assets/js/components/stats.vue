<template>
    <div class="stats-container">

        <div class="stats">

            <div class="stat-container">

                <template v-for="characterStat in characterStats">
                    <div class="stat" v-bind:class="characterStat.type">
                        <svg viewBox="0 0 64 64">
                            <use :xlink:href="`/img/character/stats/${characterStat.type}.svg#${characterStat.type}`" />
                        </svg>

                        <div class="values">
                            <span class="value">{{ characterStat.value }}</span>
                            <span class="description">{{ characterStat.type.replace('-', ' ') }}</span>
                        </div>
                    </div>
                </template>

            </div>

        </div>

    </div>
</template>
<script>
    export default {
        name: 'stats',
        props: ['stats', 'spec'],
        data() {
            return {
                allstats: this.stats[12],
                characterStats: [
                    { type: "health", value: this.stats[12]['health'] },
                    { type: this.stats[12]['powerType'], value: this.stats[12]['power'] },
                    { type: this.filterStat(), value: this.stats[12][this.mainstat()] },
                    { type: "stamina", value: this.stats[12]['sta'] },
                    { type: "critical-strike", value: this.stats[12]['crit'].toFixed(0) + '%' },
                    { type: "haste", value: this.stats[12]['haste'].toFixed(0) + '%' },
                    { type: "mastery", value: this.stats[12]['mastery'].toFixed(0) + '%' },
                    { type: "versatility", value: this.stats[12]['versatilityDamageDoneBonus'].toFixed(0) + '%' }
                ]
            }
        },
        methods: {
            mainstat() {
                switch(this.stats[4]) {
                    case 1:
                        return 'str';
                    case 2:
                        if (this.spec == 'Holy')
                        {
                            return 'int';
                        }
                        else
                        {
                            return 'str';
                        }
                    case 3:
                        return 'agi';
                    case 4:
                        return 'agi';
                    case 5:
                        return 'int';
                    case 6:
                        return 'str';
                    case 7:
                        if (this.spec == 'Enhancement')
                        {
                            return 'agi';
                        }
                        else
                        {
                            return 'int';
                        }
                    case 8:
                        return 'int';
                    case 9:
                        return 'int';
                    case 10:
                        if (this.spec == 'Mistweaver')
                        {
                            return 'int';
                        }
                        else
                        {
                            return 'agi';
                        }
                    case 11:
                        if (this.spec == 'Guardian' || this.spec == 'Feral')
                        {
                            return 'agi';
                        }
                        else
                        {
                            return 'int';
                        }
                    case 12:
                        return 'agi';
                }
            },
            filterStat() {
                switch(this.mainstat()) {
                    case 'str':
                        return 'strength';
                    case 'agi':
                        return 'agility';
                    case 'int':
                        return 'intellect';
                }
            }
        }
    }
</script>