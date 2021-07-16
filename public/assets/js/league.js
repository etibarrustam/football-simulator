function League() {
    this.playResultUrl = '/api/result';
    this.playAllUrl = '/api/play';

    this.next = async (week) => {
        let request = new Request();

        let res = await request.fetch(this.playResultUrl, {'week': week});
        this.clearDynamicContents();
        this.appendTeamData(res.data.teamData);
        this.appendMatchResults(res.data.matches);
        this.appendPredictions(res.data.percentage);
        this.appendWeek(res.data.week);
    }
    this.play = async (week) => {
        let request = new Request();

        await request.fetch(this.playAllUrl, {week: week});

        return this.next(week);
    }
    this.clearDynamicContents = () => {
        this.findByClass('dynamic-content').empty()
    }
    this.findById = (id) => {
        return $("#" + id);
    }
    this.findByClass = (className) => {
        return $("." + className);
    }
    this.appendTeamData = (data) => {
        let html = '';

        data.forEach((value, key) => {
            html += `
                <tr class="dynamic-content">
                    <td>${value.name}</td>
                    <td>${value.points}</td>
                    <td>${value.played}</td>
                    <td>${value.won}</td>
                    <td>${value.drawn}</td>
                    <td>${value.lost}</td>
                    <td>${value.goal_diff}</td>
                </tr>
            `;
        })

        return this.findById('teams').append(html);
    }
    this.appendMatchResults = (data) => {
        let html = '';

        data.forEach((value, key) => {
            html += `
                <tr class="dynamic-content">
                    <td>${value.home_team.name}</td>
                    <td>${value.home_team.pivot.goals}-${value.away_team.pivot.goals}</td>
                    <td>${value.away_team.name}</td>
                </tr>
            `;
        })

        return this.findById('matches').append(html);
    }
    this.appendPredictions = (data) => {
        let html = '';

        data.forEach((value, key) => {
            html += `
                <tr class="dynamic-content">
                    <td>${value.name}</td>
                    <td>%${value.percentage}</td>
                </tr>
            `;
        })

        return this.findById('percentage').append(html);
    }
    this.appendWeek = (week) => {
        return this.findByClass('week-count').append(week);
    }
}

