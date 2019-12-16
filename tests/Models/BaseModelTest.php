<?php

interface BaseModelTest
{
    /**
     * Test each getters / setters of model
     *
     * @return void
     */
    public function testGettersSetters(): void;

    /**
     *  Model should have access to all of it's relationship
     */
    public function testRelationship(): void;

    /**
     * Deleting a model should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void;
}
