const {connect} = require('react-redux');
const React      = require('react');
const classes    = require('classnames');
const help       = require('../../helpers/helpers');
const Scrollbars = require('react-gemini-scrollbar');

const TreeElement = React.createClass({
    getInitialState() {
        return {
            opened: false
        };
    },

    componentWillReceiveProps (nextProps) {
        let {item} = nextProps;

        let opened = this.state.opened;
        if (item.ALL_KIDS.indexOf(parseInt(nextProps.child.ID)) !== -1) {
            opened = item.ALL_KIDS.length === 1 ? false : true;
        };

        this.setState({opened})
    },

    onToggleClick(e) {
        e.stopPropagation();
        const opened = !this.state.opened;
        this.setState({opened});
    },

    select(e) {
        e.stopPropagation();
        this.props.onSelect(this.props.item.ID)
    },

    render() {
        const {item, getKids, child, isElement} = this.props;
        if (!isElement && parseInt(this.props.child.ID) === parseInt(item.ID)) return null;

        let {opened} = this.state;
        let elementHasKids = item.ALL_KIDS.length;

        if (item.ALL_KIDS.length === 1 && item.ALL_KIDS.indexOf(parseInt(child.ID)) !== -1) {
           elementHasKids = false;
        }

        let selected = parseInt(this.props.selected) === parseInt(item.ID);

        return (
            <li onClick={this.select} className={classes("list-item", {selected})}>
                {elementHasKids
                    ? <span
                    onClick={this.onToggleClick}
                    className={classes("toggle-button", {opened})}
                    title={help.t('SHOW_HIDE')}></span>
                    : null
                }
                <i className={`icon icon-folder icon-folder-sprite folder-${item.ICON}`}></i>
                <span title={item.NAME} className="one-line"><span>{item.NAME}</span></span>

                {elementHasKids && opened
                    ? <TreeList
                        isElement={this.props.isElement}
                        child={this.props.child}
                        top={false}
                        onSelect={this.props.onSelect}
                        selected={this.props.selected}
                        getKids={getKids}
                        items={getKids(item).sort(help.sortByNameAsc)}/>
                    : null
                }
            </li>
        )
    }
});

const TreeList = React.createClass({
    render() {
        return (
            <ul className={classes("list-tree", {top: this.props.top})}>
                {this.props.top && !this.props.isElement
                ? <TreeElement key={'root'} item={{ID: 0, ALL_KIDS: [], NAME: help.t('SECTIONS_ROOT')}} {...this.props} />
                : null}
                {this.props.items.filter(t => this.props.searchQuery ? t.NAME.toLowerCase().indexOf(this.props.searchQuery) > -1 : true).map((t, k) =>
                    <TreeElement key={k} item={t} {...this.props} />
                )}
            </ul>
        )
    }
});

const SelectTree = React.createClass({
    getInitialState() {
        return {
            selected: false,
            search: '',
        };
    },

    componentWillReceiveProps() {
        this.setState({selected: this.props.selected});
    },

    onSelect(selected) {
        this.setState({selected});
    },

    getKids(item) {
        return item.ALL_KIDS
            .map(i => this.props.sections[this.props.index[i]] ? this.props.sections[this.props.index[i]] : false)
            .filter(k => k && parseInt(k.SECTION) === parseInt(item.ID));
    },

    handleSearchChange(query) {
        this.setState({search: query.toLowerCase()})
    },

    render() {
        return (
            <div className="tree-popup-wrap">
                <div className="modal-header">
                    <button onClick={this.props.close} className="close">&times;</button>
                    <h4 className="modal-title">{help.t('CHOOSE_PARENT_SECTION')}</h4>
                </div>
                <div className="list-wrap modal-body">
                    <div className="name-filter">
                        <input type="text"
                               className="form-control"
                               placeholder={help.t('SEARCH_BY_NAME')}
                               onChange={e => this.handleSearchChange(e.target.value)} value={this.state.search} />
                    </div>
                    <Scrollbars>
                        <TreeList
                            isElement={this.props.isElement}
                            items={this.props.items}
                            sections={this.props.sections}
                            index={this.props.index}
                            child={this.props.child}
                            onSelect={id => this.onSelect(id)}
                            selected={this.state.selected}
                            getKids={(item) => this.getKids(item)}
                            searchQuery={this.state.search}
                            top={true} />
                    </Scrollbars>

                </div>
                <div className="modal-footer">
                    <button onClick={this.props.close} className="btn btn-default">{help.t('CANCEL')}</button>
                    <button onClick={() => this.props.onSelect(this.state.selected)} className="btn btn-primary">{help.t('CHOOSE')}</button>
                </div>
            </div>
        )
    }
});

function getBaseTree(items) {
    return items.filter((t) => parseInt(t.SECTION) === 0);
}

function mapStateToProps(state) {
    const {sections, index} = state.tree.tree;

    return {
        items: getBaseTree(sections),
        sections: sections,
        index
    }
}

function mapDispatchToProps(dispatch) {
    return {}
}

module.exports = connect(mapStateToProps, mapDispatchToProps)(SelectTree);
