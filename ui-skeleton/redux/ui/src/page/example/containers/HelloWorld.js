import { connect } from 'react-redux';
import { helloWorld } from '../actions';
import Hello from '../components/Hello';

const mapStateToProps = state => ({
  message: state.hello.message,
});

const mapDispatchToProps = dispatch => ({
  onClick: () => {
    dispatch(helloWorld());
  },
});

const HelloWorld = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Hello);

export default HelloWorld;
