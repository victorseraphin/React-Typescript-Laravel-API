import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { RouteComponentProps, withRouter, useHistory, useParams } from 'react-router-dom';
import { createStyles, makeStyles, Theme } from '@material-ui/core/styles';
import { TextField, Typography, Button } from '@material-ui/core';
import { Input, Select } from 'antd';
import SaveIcon from '@material-ui/icons/Save';
import { productService } from '../../_services';

const useStyles = makeStyles((theme: Theme) =>
  createStyles({
    root: {
      '& .MuiTextField-root': {
        margin: theme.spacing(1),
        width: 200,
        display: "block"
      },
    },
    wrapper: {
      width: "100%",
    },
    formInput: {
      width: "100%"
    },
    button: {
      margin: theme.spacing(1),
    },
  }),
);

export interface IValues {
  name: string,
  description: string,
  category: string,
  qty: number,
  price: number
}
const values: IValues = {
  name: "",
  description: "",
  category: "",
  qty: 0,
  price: 0
}

function EditProduct<RouteComponentProps>() {
  const [values, setValues] = useState({} as IValues);
  const { id } = useParams();


  const classes = useStyles();
  const history = useHistory();

  useEffect(() => {
    getData();
  }, []);

  const getData = async () => {
    const customer = await productService.getByID(id);
    await setValues(customer);
  }

  const handleChange = (event: any) => {
    event.persist();
    setValues(values => ({
      ...values,
      [event.target.name]: event.target.value
    }));
  }

  const handleSubmit = async (event: any) => {
    event.persist();
    await productService.updateItem(id, values);
    history.goBack()
  }

  return (
    <div className="site-layout-content">
      <Input.Group>
        <label>Name</label>
        <Input type="text" name="name" value={values.name} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Description</label>
        <Input type="text" name="description" value={values.description} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Category</label>
        <Input type="text" name="category" value={values.category} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Qty</label>
        <Input type="text" name="qty" value={values.qty} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Price</label>
        <Input type="text" name="price" value={values.price} onChange={handleChange} />
      </Input.Group>

      <Button
        variant="contained"
        color="primary"
        size="large"
        className={classes.button}
        startIcon={<SaveIcon />}
        onClick={handleSubmit}
      >
        Update
      </Button>
    </div>
  )
}

export default withRouter(EditProduct);