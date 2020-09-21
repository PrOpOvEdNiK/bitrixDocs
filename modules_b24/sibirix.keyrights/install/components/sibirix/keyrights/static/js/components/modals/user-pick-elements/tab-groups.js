const React      = require('react');
const classes    = require('classnames');
const extend     = require('extend');
const help = require('../../../helpers/helpers');

const GroupElement = React.createClass({
    getInitialState() {
        return {
            opened: false
        };
    },

    componentWillReceiveProps({forceExpand}) {
        if (forceExpand) this.setState({opened: true});
    },

    componentDidMount() {
        if (this.props.forceExpand) this.setState({opened: true});
    },

    toggleExpand(e) {
        e.stopPropagation();
        this.setState({opened: !this.state.opened})
    },

    select(e) {
        e.stopPropagation();
        this.props.select(this.props.element);
    },

    remove(e) {
        e.stopPropagation();
        this.props.remove(this.props.selectedGroups.indexOf(this.props.element));
    },

    render() {
        const {element, selected, hasKids, getKids, forceExpand, select, remove, selectedGroups} = this.props;
        const {opened} = this.state;

        const isSelected = selected || selectedGroups.filter(g => g.ID === element.ID).length;

        return (
            <li className={classes({selected: isSelected})} onClick={!isSelected ? this.select : this.remove}>
                <a href="javascript:void(0);">
                    {hasKids(element.ID)
                        ? <span
                        onClick={this.toggleExpand}
                        className={opened ? 'icon-expand' : 'icon-collapse'}></span>
                        : null}
                    <span dangerouslySetInnerHTML={{__html: '&nbsp;&nbsp;' + element.NAME}}></span>
                    {isSelected
                        ? <span className="minus glyphicon-minus glyphicon" title={help.t('DEL')}></span>
                        : <span className="plus glyphicon-plus glyphicon" title={help.t('ADD')}></span>
                    }
                </a>

                {!opened ? null :
                    <ul>
                        {getKids(element.ID).map((i, k) => (
                            <GroupElement
                                forceExpand={forceExpand}
                                selectedGroups={selectedGroups}
                                select={select}
                                remove={remove}
                                getKids={getKids}
                                hasKids={hasKids}
                                element={i}
                                key={k}/>
                        ))}
                    </ul>
                }
            </li>
        )
    }
});


const TabGroups = React.createClass({
    getInitialState() {
        return {
            q: ''
        };
    },

    getBaseTree(items) {
        return items.filter((i) => !i.PARENT);
    },

    getKids(id, items) {
        return items.filter((i) => parseInt(i.PARENT) === parseInt(id));
    },

    hasKids(id) {
        return this.props.groups.kidsIndex[id] === true;
    },

    _filter(items) {
        let okayItems = items.filter(i => i.NAME.toLowerCase().indexOf(this.state.q.toLowerCase()) !== -1);

        okayItems = okayItems.reduce((prev, cur) => {
            prev[cur.ID] = cur;
            if (!cur.PARENT) return prev;

            let cur2 = cur;
            while (cur2.PARENT) {
                let parent = items[this.props.groups.index[cur2.PARENT]];

                prev[parent.ID] = parent;

                cur2 = parent;
            }

            return prev;

        }, {});

        return Object.keys(okayItems).map(k => okayItems[k]);
    },

    render() {
        const {items} = this.props.groups;
        const {selectedGroups, select, remove} = this.props;

        const q = this.state.q;

        let okayItems = items;

        if (q) {
            okayItems = this._filter(items);
        }

        return (
            <div className="tab-pane active" id="groups">
                <form action="javascript:void(0);" className="form-horizontal">
                    <div className="search-wrapper">
                        <input
                            onChange={() => this.setState({q: this.search.value})}
                            value={q}
                            ref={node => this.search = node}
                            type="text"
                            className="form-control"
                            id="filter-groups"/>
                        <i className="icon-search"></i>
                    </div>
                </form>
                <div className="user-add-collapsible-list">
                    <ul>
                        {this.getBaseTree(okayItems).map((i, k) => (
                            <GroupElement
                                selected={false}
                                forceExpand={q}
                                remove={remove}
                                selectedGroups={selectedGroups}
                                select={select}
                                getKids={(id) => this.getKids(id, okayItems)}
                                hasKids={(id) => this.hasKids(id)}
                                key={k}
                                element={i}/>
                        ))}
                    </ul>
                </div>
            </div>
        );
    }
});

module.exports = TabGroups;